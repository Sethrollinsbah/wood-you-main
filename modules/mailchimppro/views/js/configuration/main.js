/**
 * PrestaChamps
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Commercial License
 * you can't distribute, modify or sell this code
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file
 * If you need help please contact leo@prestachamps.com
 *
 * @author    Mailchimp
 * @copyright Mailchimp
 * @license   commercial
 *
 * @var axios
 * @var mailchimp
 */

const {createApp} = Vue

window.app = createApp({
    methods: {
        saveSettings(reason, showResponseMessage, callbackOnSuccess, callbackOnError) {
            if (!this.preventSave) {
                this.isSaving = true;
                axios
                    .post(
                        window.configurationUrl + '&action=saveSettings',
                        {
                            action: 'saveSettings',
                            selectedPreset: this.selectedPreset,
                            multiInstanceMode: this.multiInstanceMode,
                            cronjobBasedSync: this.cronjobBasedSync,
                            syncProducts: this.syncProducts,
                            syncCustomers: this.syncCustomers,
                            syncCartRules: this.syncCartRules,
                            syncOrders: this.syncOrders,
                            syncCarts: this.syncCarts,
                            syncCartsPassw: this.syncCartsPassw,
                            syncNewsletterSubscribers: this.syncNewsletterSubscribers,
                            statusForPending: this.statusForPending,
                            statusForRefunded: this.statusForRefunded,
                            statusForCancelled: this.statusForCancelled,
                            statusForShipped: this.statusForShipped,
                            statusForPaid: this.statusForPaid,
                            productDescriptionField: this.productDescriptionField,
                            existingOrderSyncStrategy: this.existingOrderSyncStrategy,
                            productSyncFilterActive: this.productSyncFilterActive,
                            productSyncFilterVisibility: this.productSyncFilterVisibility,
                            customerSyncFilterEnabled: this.customerSyncFilterEnabled,
                            customerSyncFilterNewsletter: this.customerSyncFilterNewsletter,
                            customerSyncFilterPeriod: this.customerSyncFilterPeriod,
                            customerSyncTagDefaultGroup: this.customerSyncTagDefaultGroup,
                            customerSyncTagGender: this.customerSyncTagGender,
                            cartRuleSyncFilterStatus: this.cartRuleSyncFilterStatus,
                            cartRuleSyncFilterExpiration: this.cartRuleSyncFilterExpiration,
                            newsletterSubscriberSyncFilterPeriod: this.newsletterSubscriberSyncFilterPeriod,
                            productImageSize: this.productImageSize,
                            listId: this.listId,
                            storeSynced: this.storeSynced,
                            logQueue: this.logQueue,
                            queueStep: this.queueStep,
                            queueAttempt: this.queueAttempt,
                            logCronjob: this.logCronjob,
                            showDashboardStats: this.showDashboardStats,
                        }
                    )
                    .then((response) => {
                            this.isSaving = false;
                            this.getEntityCount();
                            if (showResponseMessage !== false) {
                                this.showSuccess('Update successful!');
                            }
                            if (reason == 'multiInstanceMode') {
                                setTimeout(function () {
                                    location.reload();
                                }, 1500);
                            }
                            if (callbackOnSuccess && typeof callbackOnSuccess == 'function') {
                                callbackOnSuccess();
                            } else if (callbackOnSuccess && typeof this[callbackOnSuccess] == 'function') {
                                this[callbackOnSuccess](...callbackOnSuccessParams);
                            }
                        }
                    );
            }
        },
        markReadJsonJobs(reason, showResponseMessage) {
            this.isSaving = true;
            axios
                .post(
                    window.configurationUrl + '&action=markReadJsonJobs',
                    {
                        action: 'markReadJsonJobs',                        
                    }
                )
                .then((response) => {
                        this.isSaving = false;
                        this.getEntityCount();

                        if (showResponseMessage !== false) {
                            this.showSuccess('Update successful!');
                        }

                        setTimeout(function () {
                            location.reload();
                        }, 100);                        
                    }
                )
        },
        markReadAutoList(reason, showResponseMessage) {
            this.isSaving = true;
            axios
                .post(
                    window.configurationUrl + '&action=markReadAutoList',
                    {
                        action: 'markReadAutoList',                        
                    }
                )
                .then((response) => {
                        this.isSaving = false;
                        this.getEntityCount();

                        if (showResponseMessage !== false) {
                            this.showSuccess('Update successful!');
                            $(".alert-auto-audience-sync").hide();
                        }

                        // setTimeout(function () {
                        //     location.reload();
                        // }, 100);                        
                    }
                )
        },
        syncStoresScript() {
            this.showLoader = true;
            axios
                .post(
                    window.configurationUrl + '&action=syncStoresScript', 
                    {
                        action: 'ajaxProcessSyncStoresScript'
                    }
                )
                .then((response) => {
                        this.showLoader = false;
                        if (response.data.hasError === false) {
                            this.showSuccess(response.data.successMessage);                            
                        }
                        else {
                            this.showError(response.data.errorMessage);
                        }
                    }
                )
        },
        syncStore() {
            this.showLoader = true;
            axios
                .post(
                    window.configurationUrl + '&action=syncStores', 
                    {
                        action: 'ajaxProcessSyncStores'
                    }
                )
                .then((response) => {
                        this.showLoader = false;
                        if (response.data.hasError === false) {
                            this.showSuccess(response.data.successMessage);
                            this.storeSynced = true;
                            $("#content > .bootstrap .alert-info").addClass('hidden');
                        }
                        else {
                            this.showError(response.data.errorMessage);
                            this.storeSynced = false;
                        }
                    }
                )
        },
        getEntityCount() {
            axios
                .post(
                    window.configurationUrl + '&action=getEntityCount',
                    {
                        action: 'getEntityCount',
                    }
                )
                .then((response) => {
                        this.numberOfCartRulesToSync = response.data.cartRules;
                        this.numberOfCustomersToSync = response.data.customers;
                        this.numberOfProductsToSync = response.data.products;
                        this.numberOfOrdersToSync = response.data.orders;
                        this.numberOfNewsletterSubscribersToSync = response.data.newsletterSubscribers;
                    }
                )
        },
        updateStaticContent() {
            axios
                .post(
                    window.configurationUrl + '&action=updateStaticContent',
                    {
                        action: 'ajaxProcessUpdateStaticContent',
                    }
                )
                .then((response) => {
                        this.cronjobLogContent = response.data.cronjobLogContent;
                        this.lastSyncedProductId = response.data.lastSyncedProductId;
                        this.lastSyncedCustomerId = response.data.lastSyncedCustomerId;
                        this.lastSyncedCartRuleId = response.data.lastSyncedCartRuleId;
                        this.lastSyncedOrderId = response.data.lastSyncedOrderId;
                        this.lastSyncedCartId = response.data.lastSyncedCartId;
                        this.lastSyncedNewsletterSubscriberId = response.data.lastSyncedNewsletterSubscriberId;
                        this.lastCronjob = response.data.lastCronjob;
                        this.lastCronjobExecutionTime = response.data.lastCronjobExecutionTime;
                        this.totalJobs = response.data.totalJobs;
                    }
                )
        },
        disconnect() {
            if (confirm("Do you really want to log out?")) {
                axios
                    .post(
                        window.configurationUrl + '&action=disconnect',
                        {
                            action: 'disconnect',
                        }
                    )
                    .then((response) => {
                            this.accountInfo = response.data.accountInfo;
                            this.validApiKey = response.data.validApiKey;
                            
                            $('#content > .bootstrap .alert-info').addClass('hidden');
                        }
                    )
            }
        },
        oauthStart() {
            let width = 500;
            let height = 900;
            let left = (screen.width / 2) - (width / 2);
            let top = (screen.height / 2) - (height / 2);

            window.open(
                window.middlewareUrlUpgraded,
                "McAuthMiddleware",
                'width=' + width + ', height=' + height + ', top=' + top + ', left=' + left + ",resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes"
            );
        },
        setCurrentPage(currentPage) {
            this.currentPage = currentPage;
            const url = new URL(window.location);
            url.hash = '#' + currentPage;
            window.history.pushState({}, '', url);
            
            this.updateStaticContent();
        },
        getCurrentPage(defaultValue) {
            let validApiKey = window.mailchimp.validApiKey;
            let listId = window.mailchimp.listId;
            let storeSynced = window.mailchimp.storeSynced;
            let selectedPreset = window.mailchimp.selectedPreset;
            let lastCronjob = window.mailchimp.lastCronjob;
            if (!defaultValue) {
                validApiKey = this.validApiKey;
                listId = this.listId;
                storeSynced = this.storeSynced;
                selectedPreset = this.selectedPreset;
                lastCronjob = this.lastCronjob;
            }
            let currentPage = window.location.hash.slice(1);
            if (validApiKey && (!selectedPreset || (!currentPage && !(listId && storeSynced && selectedPreset && lastCronjob)))) {
                window.location.hash = 'presets';
                return 'presets';
            }
            if (!currentPage) {
                currentPage = 'presets';
            }
            return currentPage;
        },
        isPanelStepAvailable(step) {
            switch(step) {
                case 'sync-store':
                    return true;
                case 'select-preset':
                    return this.selectedPreset || (this.validApiKey && this.listId && this.storeSynced && !this.selectedPreset);
                case 'setup-cronjob':
                    return this.validApiKey && this.listId && this.storeSynced && this.selectedPreset && this.cronjobBasedSync;
                default:
                    return false;
            }
        },
        isPanelStepActive(step) {
            switch(step) {
                case 'sync-store':
                    return !(this.validApiKey && this.listId && this.storeSynced);
                case 'select-preset':
                    return (this.validApiKey && this.listId && this.storeSynced && (!this.selectedPreset || (this.selectedPreset && !this.cronjobBasedSync))) || (this.validApiKey && this.listId && this.storeSynced && this.lastCronjob);
                case 'setup-cronjob':
                    return this.validApiKey && this.listId && this.storeSynced && this.selectedPreset && this.cronjobBasedSync && !this.lastCronjob;
                default:
                    return false;
            }
        },
        isPanelStepDone(step) {
            switch(step) {
                case 'sync-store':
                    return this.validApiKey && this.listId && this.storeSynced;
                case 'select-preset':
                    return this.validApiKey && this.selectedPreset;
                case 'setup-cronjob':
                    return this.validApiKey && this.listId && this.storeSynced && this.selectedPreset && this.lastCronjob;
                default:
                    return false;
            }
        },
        selectPanelStep(event) {
            if (event.target.classList.contains('panel-step') || event.target.closest('.panel-step')) {
                let currentStep = event.target.classList.contains('panel-step') ? event.target : event.target.closest('.panel-step');
                let currentStepContent = currentStep.dataset.stepTarget;
                // if (!currentStep) {
                //     currentStep = event.target.closest('.panel-step').dataset.stepTarget;
                // }
                if ($(currentStep).length && $('.' + currentStepContent).length) {
                    $(currentStep).addClass('active').siblings('.panel-step').removeClass('active');
                    $('.' + currentStepContent).addClass('active').siblings('.step-content').removeClass('active');
                }
            }
        },
        selectPreset(event) {
            if (event.target.closest('.panel') && event.target.closest('.panel').dataset.preset) {
                let currentPreset = event.target.closest('.panel').dataset.preset;
                let selectedPresetDefaults = this.definedPresets[currentPreset]['config-values'];

                // check if all keys in the selectedPresetDefaults object are present in the current data (this) object object:
                if (selectedPresetDefaults && Object.keys(selectedPresetDefaults).every(key => key in this)) {
                    // prevent running save function for every changed option
                    this.preventSave = true;
                    // update current data values:
                    Object.keys(selectedPresetDefaults).forEach(key => {
                        // if (key in this) {
                            this[key] = selectedPresetDefaults[key];
                        // }
                    });
                    // update selected preset value:
                    this.selectedPreset = currentPreset;
                    // wait for watchers to finish
                    setTimeout(function (_this) {
                        _this.preventSave = false;
                        if (_this.selectedPreset == 'custom') {
                            // when the selected preset is custom, only delete existing jobs, they would have to add them manually
                            _this.saveSettings('selectPreset', true, () => {_this.clearJobs('selectPreset', true)});
                        } else {
                            // else delete existing jobs, and add them based on the selected preset automatically
                            _this.saveSettings('selectPreset', true, () => {_this.clearJobs('selectPreset', true, () => {_this.pushSetupJobsToQueue('selectPreset', true)})});
                        }
                    }, 200, this);
                } else {
                    this.showError('Incorrect preset-defaults configuration!');
                }
            }
        },
        // set the current preset based on the current configuration data
        manageSelectedPreset() {
            let determinedPreset = this.determinePreset();
            if (this.selectedPreset && this.selectedPreset != determinedPreset) {
                // prevent running save function when changing the preset by configuration data
                this.preventSave = true;
                this.selectedPreset = determinedPreset;
                setTimeout(function (_this) {
                    _this.preventSave = false;
                    // update selected preset value:
                    _this.saveSettings('selectedPreset', false);
                }, 100, this);
            }
        },
        determinePreset() {
            const definedPresets = this.definedPresets;

            for (const key in definedPresets) {
                const configValues = definedPresets[key]['config-values'];
                const isMatch = Object.keys(configValues).every((configKey) => {
                    const dataValue = this[configKey];
                    const configValue = configValues[configKey];

                    if (Array.isArray(configValue)) {
                        // Check if both arrays are deeply equal
                        return Array.isArray(dataValue) && JSON.stringify(dataValue) === JSON.stringify(configValue);
                    }

                    // Check if primitive values match
                    return dataValue === configValue;
                });

                if (isMatch) {
                    // console.log(key);
                    if (key == 'free' && this.selectedPreset != 'free' && !this.isFreePresetAvailable()) {
                        return 'custom';
                    }
                    return key; // Return the matching main key
                }
            }
            // console.log('custom');

            return 'custom'; // Return 'custom' if no match is found
        },
        isFreePresetAvailable() {
            return this.accountInfo && this.accountInfo.total_subscribers && this.accountInfo.total_subscribers <= this.definedPresets['free']['list-member-limit'];
        },
        dropDownToggle(event) {
            let dropdownItem = event.target.closest('[aria-expanded]');
            if (dropdownItem) {
                dropdownItem.setAttribute("aria-expanded", !(dropdownItem.getAttribute("aria-expanded") == 'true'));
            }
        },
        arrayEquals(a, b) {
            if (a.length !== b.length) return false;
            const uniqueValues = new Set([...a, ...b]);
            for (const v of uniqueValues) {
                const aCount = a.filter(e => e === v).length;
                const bCount = b.filter(e => e === v).length;
                if (aCount !== bCount) return false;
            }
            return true;
        },
        getUniqueConfigKeys(data) {
            const keys = new Set();
            // Iterate through each top-level key
            Object.values(data).forEach(section => {
                if (section['config-values']) {
                    // Add the keys from 'config-values' to the set
                    Object.keys(section['config-values']).forEach(key => keys.add(key));
                }
            });

            return Array.from(keys); // Convert the Set to an Array
        },
        pushSetupJobsToQueue(reason, showResponseMessage) {
			this.isSaving = true;
            let requests = [];
            // stores
            // requests.push(axios.post(window.configurationUrl + '&action=syncStores', {action: 'ajaxProcessSyncStores'}))
            let jobsAddedToQueue = 0;
            if (this.syncProducts) {
                requests.push(axios.post(window.configurationUrl + '&action=addProductsToQueue', {action: 'ajaxProcessAddProductsToQueue'}));
                
                // filling the specific price table with initial values
                requests.push(axios.post(window.configurationUrl + '&action=initializeSpecificPrices', {action: 'ajaxProcessSpecificPrices'}));
                jobsAddedToQueue += this.numberOfProductsToSync;
            }
            if (this.syncCustomers) {
                requests.push(axios.post(window.configurationUrl + '&action=addCustomersToQueue', {action: 'ajaxProcessAddCustomersToQueue'}));
                jobsAddedToQueue += this.numberOfCustomersToSync;
            }
            if (this.syncOrders) {
                requests.push(axios.post(window.configurationUrl + '&action=addOrdersToQueue', {action: 'ajaxProcessAddOrdersToQueue'}));
                jobsAddedToQueue += this.numberOfOrdersToSync;
            }
            if (this.syncCartRules) {
                requests.push(axios.post(window.configurationUrl + '&action=addCartRulesToQueue', {action: 'ajaxProcessAddCartRulesToQueue'}));
                jobsAddedToQueue += this.numberOfCartRulesToSync;
            }
            if (this.syncNewsletterSubscribers) {
                requests.push(axios.post(window.configurationUrl + '&action=addNewsletterSubscribersToQueue', {action: 'ajaxProcessAddNewsletterSubscribersToQueue'}));
                jobsAddedToQueue += this.numberOfNewsletterSubscribersToSync;
            }

            axios
                .all(requests)
                .then(
                    axios.spread((...responses) => {
                        console.log(responses);
						this.jobsAddedToQueue = true;
						this.isSaving = false;
                        //window.location = window.queueUrl;
                        if (showResponseMessage) {
                            if (jobsAddedToQueue) {
                                this.showSuccess('Jobs successfully added to queue!');
                                this.totalJobs = jobsAddedToQueue;
                            } else {
                                console.log('No jobs have been added to queue!');
                            }
                        }
                    })
                )
                .catch(errors => {
                    // react on errors.
                    console.error(errors);
					this.isSaving = false;
                    if (showResponseMessage) {
                        this.showSuccess('Something went wrong adding jobs to queue!');
                    }
                });
        },
        clearJobs(reason, showResponseMessage, callbackOnSuccess, callbackOnError) {
            if (this.totalJobs && this.totalJobs > 0) {
                this.isSaving = true;
                axios
                    .post(
                        window.queueUrl + '&action=clearJobs'
                    )
                    .catch((error) => {
                        this.isSaving = false;
                        if (error.response) {
                            this.showError(error.response.data)
                        } else if (error.request) {
                            this.showError(error.response.data)
                        } else {
                            this.showError(error.message)
                        }
                        if (showResponseMessage) {
                            this.showSuccess('Something went wrong clearing previous jobs!');
                        }
                    })
                    .then(response => {
                        this.isSaving = false;
                        if (showResponseMessage) {
                            if (reason == 'selectPreset') {
                                this.showSuccess('Previous jobs deleted successfully!');
                            } else {
                                this.showSuccess('Jobs deleted successfully!');
                            }
                        }
                        if (callbackOnSuccess && typeof callbackOnSuccess == 'function') {
                            callbackOnSuccess();
                        } else if (callbackOnSuccess && typeof this[callbackOnSuccess] == 'function') {
                            this[callbackOnSuccess](...callbackOnSuccessParams);
                        }
                        this.totalJobs = (response && response.data && response.data.numberOfJobsAvailable) ? response.data.numberOfJobsAvailable : 0;
                    })
            } else {
                console.log('Total jobs: ' + this.totalJobs + ' - no deletion needed.');
                // if (showResponseMessage) {
                //     this.showSuccess('No previous jobs have been deleted!');
                // }
                if (callbackOnSuccess && typeof callbackOnSuccess == 'function') {
                    callbackOnSuccess();
                } else if (callbackOnSuccess && typeof this[callbackOnSuccess] == 'function') {
                    this[callbackOnSuccess](...callbackOnSuccessParams);
                }
            }
        },
        deleteMailchimpEcommerceData() {
            if (confirm("Do you really want to delete?")) {
                this.showLoader = true;
                axios
                    .post(
                        window.configurationUrl + '&action=deleteEcommerceData',
                        {
                            action: 'ajaxProcessDeleteEcommerceData',
                        }
                    )
                    .then((response) => {
                            this.showLoader = false;
                            if (response.data.hasError === false) {
                                this.showSuccess(response.data.successMessage);
                            }
                            else {
                                this.showError(response.data.errorMessage);
                            }
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        }
                    )
            }
        },
        executeCronjob(e) {
            e.preventDefault();
            this.showLoader = true;
            axios
                .post(
                    window.configurationUrl + '&action=executeCronjob&secure=' + window.cronjobSecureToken,
                    {
                        action: 'ajaxProcessExecuteCronjob',
                    }
                )
                .then((response) => {
                        this.showLoader = false;
                        if (response.data.errors) {
                            this.showError(response.data.errors);
                        }
                        else {
                            if (response.data.result) {
                                this.showSuccess(response.data.result);
                            }
                        }

                        this.updateStaticContent();
                    }
                )
        },
        clearCronjobLog() {
            if (confirm("Do you really want to clear the cronjob log?")) {
                this.showLoader = true;
                axios
                    .post(
                        window.configurationUrl + '&action=clearCronjobLog',
                        {
                            action: 'ajaxProcessClearCronjobLog',
                        }
                    )
                    .then((response) => {
                            this.showLoader = false;
                            if (response.data.hasError === false) {
                                this.showSuccess(response.data.successMessage);
                            }
                            else {
                                this.showError(response.data.errorMessage);
                            }

                            this.updateStaticContent();
                        }
                    )
            }
        },
        refreshReports() {
            this.showLoader = true;
            axios
                .post(
                    window.configurationUrl + '&action=refreshReports',
                    {
                        action: 'refreshReports',
                    }
                )
                .then((response) => {
                        this.showLoader = false;
                        $('.panel-statistics #mailchimp-reports').replaceWith(response.data.statistics);
                    }
                )
        },
        showError(message) {
            Toastify({
                text: message,
                duration: 2000,
                close: true,
                gravity: "top",
                position: 'center',
                style: {
                    background: "#ff0000",
                },
                stopOnFocus: false,
            }).showToast();
        },
		showSuccess(message) {
            Toastify({
                text: message,
                duration: 2000,
                close: true,
                gravity: "top",
                position: 'center',
                style: {
                    background: "#1a8f35",
                },
                stopOnFocus: false,
            }).showToast();
        }
    },
    watch: {
        listId: function () {
            if (this.listId) {
                this.storeSynced = false;
            }
            this.saveSettings();
        },
        multiInstanceMode: function () {
            if (this.storeInstanceMode != this.multiInstanceMode) {
                this.storeSynced = false;
                this.listId = false;
                this.saveSettings("multiInstanceMode", false);
            }
            else {
                this.saveSettings("multiInstanceMode", true);
            }
        },
        selectedPreset: function (newValue, oldValue) {
            // if (oldValue || newValue == 'custom') {
            //     this.saveSettings();
            // } else {
            //     // automatically add jobs to queue on first preset selection
            //     // this.saveSettings('saveSettings', true, 'pushSetupJobsToQueue');
            //     this.saveSettings('saveSettings', true, () => {this.pushSetupJobsToQueue()});
            // }
            this.saveSettings();
        },
        cronjobBasedSync: function () {
            this.saveSettings();
        },
        syncProducts: function () {
            this.saveSettings();
        },
        syncCustomers: function () {
            this.saveSettings();
        },
        syncCartRules: function () {
            this.saveSettings();
        },
        syncOrders: function () {
            this.saveSettings();
        },
        syncCarts: function () {
            this.saveSettings();
        },
        syncCartsPassw: function () {
            this.saveSettings();
        },
        syncNewsletterSubscribers: function () {
            this.saveSettings();
        },
        statusForPending: function () {
            this.saveSettings();
        },
        statusForRefunded: function () {
            this.saveSettings();
        },
        statusForCancelled: function () {
            this.saveSettings();
        },
        statusForShipped: function () {
            this.saveSettings();
        },
        statusForPaid: function () {
            this.saveSettings();
        },
        productDescriptionField: function () {
            this.saveSettings();
        },
        existingOrderSyncStrategy: function () {
            this.saveSettings();
        },
        productSyncFilterActive: function () {
            this.saveSettings();
        },
        productSyncFilterVisibility: function () {
            this.saveSettings();
        },
        customerSyncFilterEnabled: function () {
            this.saveSettings();
        },
        customerSyncFilterNewsletter: function () {
            this.saveSettings();
        },
        customerSyncFilterPeriod: function () {
            this.saveSettings();
        },
        customerSyncTagDefaultGroup: function () {
            this.saveSettings();
        },
        customerSyncTagGender: function () {
            this.saveSettings();
        },
        cartRuleSyncFilterStatus: function () {
            this.saveSettings();
        },
        newsletterSubscriberSyncFilterPeriod: function () {
            this.saveSettings();
        },
        cartRuleSyncFilterExpiration: function () {
            this.saveSettings();
        },
        productImageSize: function () {
            this.saveSettings();
        },
		logQueue: function () {
            this.saveSettings();
        },
        showDashboardStats: function () {
            this.saveSettings();
        },
		queueStepRaw: function () {
			if (!isNaN(parseInt(this.queueStepRaw)) && parseInt(this.queueStepRaw) > 0) {
				this.queueStepRaw = parseInt(this.queueStepRaw);
				if (this.queueStep != this.queueStepRaw) {
					this.queueStep = this.queueStepRaw;
					this.saveSettings();
				}
			}
			else {
				this.showError('Invalid queue step!');
			}
        },
		queueAttemptRaw: function () {
			if (!isNaN(parseInt(this.queueAttemptRaw)) && parseInt(this.queueAttemptRaw) > 0) {
				this.queueAttemptRaw = parseInt(this.queueAttemptRaw);
				if (this.queueAttempt != this.queueAttemptRaw) {
					this.queueAttempt = this.queueAttemptRaw;
					this.saveSettings();
				}
			}
			else {
				this.showError('Invalid queue max-trying time!');
			}
        },
        logCronjob: function () {
            this.saveSettings();
        }
    },
    mounted() {
        this.timer = setInterval(() => {
            if (this.getCurrentPage() !== this.currentPage) {
                this.currentPage = this.getCurrentPage();
            }
        }, 100);
        window.addEventListener(
            "message",
            (event) => {
                if (event.origin !== window.middlewareUrl) {
                    return false;
                }
                if (event.data.hasOwnProperty('token') && event.data.hasOwnProperty('user')) {
                    const token = event.data.token + "-" + event.data.user.dc;
                    axios
                        .post(
                            window.configurationUrl + '&action=connect',
                            {
                                action: 'connect',
                                token: token
                            }
                        )
                        .then((response) => {
                                /* this.accountInfo = response.data.accountInfo;
                                this.validApiKey = response.data.validApiKey; */
                                
                                //setTimeout(function () {
                                    location.reload();
                                //}, 500);
                            }
                        )
                }
            },
            true
        );


        // Add dynamic watch to all the data which affect the current preset:
        // Get unique preset affecting config keys
        const uniquePresetConfigKeys = this.getUniqueConfigKeys(this.definedPresets);
        // Add watchers dynamically for each unique key
        uniquePresetConfigKeys.forEach(key => {
            if (this[key] !== undefined) {
                this.$watch(
                    key,
                    (newValue, oldValue) => {
                        // console.log(`Key '${key}' changed:`, oldValue, '->', newValue);
                        // manage selected preset only when the value of the watched key is changed manually and not by triggered from selectPreset()
                        if (!this.preventSave) {
                            this.manageSelectedPreset();
                        }
                    },
                    { immediate: false } // Optional: Run the watcher immediately on initialization
                );
            }
        });

        this.manageSelectedPreset();
    },
    data() {
        return {
            isSaving: false,
            preventSave: false,
            showLoader: false,
			jobsAddedToQueue: false,
            definedPresets: window.mailchimp.definedPresets,
            selectedPreset: window.mailchimp.selectedPreset,
            currentPage: this.getCurrentPage(true),
            listId: window.mailchimp.listId,
            lists: window.mailchimp.lists,
            storeAlreadySynced: window.storeAlreadySynced ?? false,
            storeSynced: window.mailchimp.storeSynced,
            orderStates: window.mailchimp.orderStates,
            storeInstanceMode: window.mailchimp.multiInstanceMode,
            multiInstanceMode: window.mailchimp.multiInstanceMode,
            cronjobBasedSync: window.mailchimp.cronjobBasedSync,
            syncProducts: window.mailchimp.syncProducts,
            syncCustomers: window.mailchimp.syncCustomers,
            syncCartRules: window.mailchimp.syncCartRules,
            syncOrders: window.mailchimp.syncOrders,
            syncCarts: window.mailchimp.syncCarts,
            syncCartsPassw: window.mailchimp.syncCartsPassw,
            syncNewsletterSubscribers: window.mailchimp.syncNewsletterSubscribers,
            statusForPending: (window.mailchimp.statusForPending),
            statusForRefunded: (window.mailchimp.statusForRefunded),
            statusForCancelled: (window.mailchimp.statusForCancelled),
            statusForShipped: (window.mailchimp.statusForShipped),
            statusForPaid: (window.mailchimp.statusForPaid),
            productDescriptionField: window.mailchimp.productDescriptionField,
            existingOrderSyncStrategy: window.mailchimp.existingOrderSyncStrategy,
            productSyncFilterActive: (window.mailchimp.productSyncFilterActive),
            productSyncFilterVisibility: (window.mailchimp.productSyncFilterVisibility),
            customerSyncFilterEnabled: (window.mailchimp.customerSyncFilterEnabled),
            customerSyncFilterNewsletter: (window.mailchimp.customerSyncFilterNewsletter),
            customerSyncFilterPeriod: window.mailchimp.customerSyncFilterPeriod,
            customerSyncTagDefaultGroup: window.mailchimp.customerSyncTagDefaultGroup,
            customerSyncTagGender: window.mailchimp.customerSyncTagGender,
            cartRuleSyncFilterStatus: (window.mailchimp.cartRuleSyncFilterStatus),
            cartRuleSyncFilterExpiration: (window.mailchimp.cartRuleSyncFilterExpiration),
            newsletterSubscriberSyncFilterPeriod: window.mailchimp.newsletterSubscriberSyncFilterPeriod,
            productImageSize: window.mailchimp.productImageSize,
            token: window.mailchimp.token,
            validApiKey: window.mailchimp.validApiKey,
            accountInfo: window.mailchimp.accountInfo,
            numberOfCartRulesToSync: window.mailchimp.numberOfCartRulesToSync,
            numberOfCustomersToSync: window.mailchimp.numberOfCustomersToSync,
            numberOfProductsToSync: window.mailchimp.numberOfProductsToSync,
            numberOfOrdersToSync: window.mailchimp.numberOfOrdersToSync,
            numberOfNewsletterSubscribersToSync: window.mailchimp.numberOfNewsletterSubscribersToSync,
            logQueue: window.mailchimp.logQueue,
            queueStep: window.mailchimp.queueStep,
            queueStepRaw: window.mailchimp.queueStep,
            queueAttempt: window.mailchimp.queueAttempt,
            queueAttemptRaw: window.mailchimp.queueAttempt,
			logCronjob: window.mailchimp.logCronjob,
			cronjobLogContent: window.mailchimp.cronjobLogContent,
			lastSyncedProductId: window.mailchimp.lastSyncedProductId,
			lastSyncedCustomerId: window.mailchimp.lastSyncedCustomerId,
            lastSyncedCartRuleId: window.mailchimp.lastSyncedCartRuleId,
			lastSyncedOrderId: window.mailchimp.lastSyncedOrderId,
            lastSyncedCartId: window.mailchimp.lastSyncedCartId,
			lastSyncedNewsletterSubscriberId: window.mailchimp.lastSyncedNewsletterSubscriberId,
			lastCronjob: window.mailchimp.lastCronjob,
			lastCronjobExecutionTime: window.mailchimp.lastCronjobExecutionTime,
			totalJobs: window.mailchimp.totalJobs,
            showDashboardStats: window.mailchimp.showDashboardStats,
        }
    }
});
window.app.component('multiselect', window.VueformMultiselect)
window.app.mount('#app')