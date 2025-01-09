<?php
/**
* 2007-2018 Prestapro
*
* Contibutors: Andrey, Amazzing
*
*  @author    Prestapro <mail@prestapro.ru>
*  @copyright 2007-2018 Prestapro
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*/

class TwitterWidget extends Module
{
	public function __construct()
	{
		if (!defined('_PS_VERSION_')) {
			exit;
		}
		$this->name = 'twitterwidget';
		$this->tab = 'front_office_features';
		$this->version = '1.1.0';
		$this->author = 'prestapro.ru';
		$this->bootstrap = true;
		$this->need_instance = 0;

		parent::__construct();

		$this->displayName = $this->l('Responsive twitter widget');
		$this->description = $this->l('Displays latest tweets in carousel anywhere on your site');
	}

	public function fillMultilangValues()
	{
		$languages = Language::getLanguages(false);
		$shop_ids = Shop::getShops(false, null, true);
		foreach ($this->getMultilangFields(false) as $name => $data) {
			foreach ($languages as $lang) {
				$key = Tools::strtoupper('TWITT_'.$name).'_'.$lang['id_lang'];
				$value = html_entity_decode($data[1]);
				foreach ($shop_ids as $id_shop) {
					Configuration::updateValue($key, $value, false, null, $id_shop);
				}
			}
		}
		return true;
	}

	public function getMultilangFields($only_keys = true)
	{
		$fields = array(
			'title_text' => array(
				$this->l('Title'),
				$this->l('Recent Tweets'),
			),
			'undertitle_text' => array(
				$this->l('Subtitle'),
				'',
			),
		);
		return $only_keys ? array_keys($fields) : $fields;
	}

	private function updateLanguageField($field_name)
	{
		$lang_default = (int)Configuration::get('PS_LANG_DEFAULT');
		$field = array($lang_default => Tools::getValue('TWITT_'.$field_name.'_'.$lang_default));
		$this->context->controller->getLanguages();
		foreach ($this->context->controller->_languages as $lang) {
			if ($lang['id_lang'] == $lang_default) {
				continue;
			}
			$field_value = Tools::getValue('TWITT_'.$field_name.'_'.(int)$lang['id_lang']);
			if (!empty($field_value)) {
				$field[(int)$lang['id_lang']] = $field_value;
			} else {
				$field[(int)$lang['id_lang']] = $field[$lang_default];
			}
		}
		foreach ($this->context->controller->_languages as $lang) {
			Configuration::updateValue(
				'TWITT_'.Tools::strtoupper($field_name).'_'.(int)$lang['id_lang'],
				$field[(int)$lang['id_lang']]
			);
		}
	}

	public function install()
	{
		if (Shop::isFeatureActive()) {
			Shop::setContext(Shop::CONTEXT_ALL);
		}

		$default_hook = 'displayHomeCustom';
		$default_position = '5';

		$ret = parent::install()
			&& $this->registerHook('displayHeader')
			&& $this->registerHook('backOfficeHeader')
			&& $this->registerHook($default_hook)
			&& Configuration::updateValue('TWITT_HOOK', $default_hook)
			&& Configuration::updateValue('TWITTLOGIN', 'prestashop')
			&& Configuration::updateValue('NUMBEROFTWITTS', '5')
			&& Configuration::updateValue('tw_oauth_access_token', '3331104861-hoDWPgQjjvFEZJO5gnSWGXxwRx470qNH3z9qyrJ')
			&& Configuration::updateValue('tw_oauth_access_token_secret', 'Mg1DPl6NqrZ5MT5R2f5qo9uzvIjxB3G56H6p7yo71Ozvx')
			&& Configuration::updateValue('tw_consumer_key', 'DvZDl5QL8Bgw8d0oTv0gPqwYF')
			&& Configuration::updateValue('tw_consumer_secret', 'e8i6RcqH8bD5BRgmbLkkLU6x8Dm6oEqWzHkBSakdESbOObBNwc')
			&& $this->fillMultilangValues();
		if ($ret) {
			// in some cases updatePosition doesnt return true
			$this->updatePosition(Hook::getIdByName($default_hook), 0, $default_position);
		}
		return $ret;
	}

	public function uninstall()
	{
		return parent::uninstall()
			&& Configuration::deleteByName('TWITTLOGIN')
			&& Configuration::deleteByName('tw_oauth_access_token')
			&& Configuration::deleteByName('tw_oauth_access_token_secret')
			&& Configuration::deleteByName('tw_consumer_key')
			&& Configuration::deleteByName('tw_consumer_secret')
			&& Configuration::deleteByName('NUMBEROFTWITTS')
			&& Configuration::deleteByName('TWITT_HOOK');
	}

	public function getAvailableHooks()
	{
		$methods = get_class_methods(__CLASS__);
		$methods_to_exclude = array('hookDisplayBackOfficeHeader', 'hookDisplayHeader');
		$available_hooks = array();
		foreach ($methods as $m) {
			if (Tools::substr($m, 0, 11) === 'hookDisplay' && !in_array($m, $methods_to_exclude)) {
				$available_hooks[] = str_replace('hookDisplay', 'display', $m);
			}
		}
		return $available_hooks;
	}

	public function getContent()
	{
		$output = null;

		if (Tools::isSubmit('submit'.$this->name)) {
			$twittlogin = Tools::getValue('TWITTLOGIN');
			$numberoftwitts = Tools::getValue('NUMBEROFTWITTS');

			if (!$twittlogin || empty($twittlogin) || !Validate::isGenericName($twittlogin) ||
				!Validate::isUnsignedInt($numberoftwitts)) {
				$error = $this->l('Make sure login in not empty and count of tweets is numeric');
				$output .= $this->displayError($error);
			} else {
				Configuration::updateValue('TWITTLOGIN', $twittlogin);
				Configuration::updateValue('NUMBEROFTWITTS', $numberoftwitts);
				Configuration::updateValue('tw_oauth_access_token', Tools::getValue('tw_oauth_access_token'));
				Configuration::updateValue('tw_oauth_access_token_secret', Tools::getValue('tw_oauth_access_token_secret'));
				Configuration::updateValue('tw_consumer_key', Tools::getValue('tw_consumer_key'));
				Configuration::updateValue('tw_consumer_secret', Tools::getValue('tw_consumer_secret'));
				$submitted_hook = Tools::getValue('TWITT_HOOK');
				if (Configuration::get('TWITT_HOOK') != $submitted_hook) {
					Configuration::updateValue('TWITT_HOOK', $submitted_hook);
					$hooks = $this->getAvailableHooks();
					foreach ($hooks as $hook) {
						$this->unregisterHook($hook);
					}
					$this->registerHook($submitted_hook);
					// move to 1st position in footer
					if ($submitted_hook == 'displayFooter') {
						$this->updatePosition(Hook::getIdByName($submitted_hook), 0, 1);
					}
				}
				foreach ($this->getMultilangFields() as $field_name) {
					$this->updateLanguageField($field_name);
				}
				$output .= $this->displayConfirmation($this->l('Settings updated'));
			}
		}
		return $output.$this->displayForm();
	}

	public function displayForm()
	{
		// Get default Language
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
		$available_hooks = $this->getAvailableHooks();
		$hook_radio_values = array();
		foreach ($available_hooks as $h) {
			$hook_radio_values[] = array(
				'id' => 'hook_'.$h,
				'value' => $h,
				'label' => $h,
			);
		}

		$multilang_fields = array();
		foreach ($this->getMultilangFields(false) as $name => $data) {
			$multilang_fields[$name] = array(
				'type'  => 'text',
				'label' => $data[0],
				'name'  => 'TWITT_'.$name,
				'lang'  => true,
				'col'   => 8,
			);
		}

		// Init Fields form array
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Settings'),
				),
				'input' => array(
					$multilang_fields['title_text'],
					$multilang_fields['undertitle_text'],
					array(
						'type'     => 'text',
						'label'    => $this->l('Your twitter login'),
						'name'     => 'TWITTLOGIN',
						'size'     => 20,
						'col'      => 6,
						'required' => true,
					),
					array(
						'type'     => 'text',
						'label'    => $this->l('Number of tweets'),
						'name'     => 'NUMBEROFTWITTS',
						'size'     => 20,
						'col'      => 6,
						'required' => true,
						),
					array(
						'type'     => 'radio',
						'label'    => $this->l('Select hook'),
						'name'     => 'TWITT_HOOK',
						'values'   => $hook_radio_values,
						'required' => true,
					),
					array(
						'type'     => 'text',
						'label'    => $this->l('Consumer Key (API Key)'),
						'name'     => 'tw_consumer_key',
						'size'     => 20,
						'col'      => 6,
						'required' => true,
					),
					array(
						'type'     => 'text',
						'label'    => $this->l('Consumer Secret (API Secret)'),
						'name'     => 'tw_consumer_secret',
						'size'     => 20,
						'col'      => 6,
						'required' => true,
					),
					array(
						'type'     => 'text',
						'label'    => $this->l('Access Token'),
						'name'     => 'tw_oauth_access_token',
						'size'     => 20,
						'col'      => 6,
						'required' => true,
					),
					array(
						'type'     => 'text',
						'label'    => $this->l('Access Token Secret'),
						'name'     => 'tw_oauth_access_token_secret',
						'size'     => 20,
						'col'      => 6,
						'required' => true,
					),
				),
				'submit' => array(
					'title' => $this->l('Save'),
					'class' => 'btn btn-default'
				)
			)
		);
		$helper = new HelperForm();
		// Module, token and currentIndex
		$helper->module = $this;
		// $this->fields_form = array();
		$helper->name_controller = $this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		// Language
		$helper->default_form_language = $default_lang;
		$allow_employee_form_lang =  Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG');
		$helper->allow_employee_form_lang = $allow_employee_form_lang ? $allow_employee_form_lang : 0;
		//$helper->allow_employee_form_lang = $default_lang;
		// Title and toolbar
		$helper->title = $this->displayName;
		$helper->show_toolbar = true;// false -> remove toolbar
		$helper->toolbar_scroll = true;// yes - > Toolbar is always visible on the top of the screen.
		$helper->submit_action = 'submit'.$this->name;
		$helper->toolbar_btn = array(
			'save' =>
			array(
				'desc' => $this->l('Save'),
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
				'&token='.Tools::getAdminTokenLite('AdminModules'),
			),
			'back' => array(
				'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
				'desc' => $this->l('Back to list')
			)
		);
		// Load current value
		$language = $this->context->controller->getLanguages();
		$field_values = $this->getConfigFieldsValues();

		foreach ($this->context->controller->_languages as $lang) {
			foreach ($this->getMultilangFields() as $field_name) {
				$field_name = 'TWITT_'.$field_name;
				$configuration_key = Tools::strtoupper($field_name.'_'.$lang['id_lang']);
				$field_values[$field_name][$lang['id_lang']] = Configuration::get($configuration_key);
			}
		}

		$helper->tpl_vars = array(
			'fields_value' => $field_values,
			'languages' => $language,
			'id_language' => $this->context->language->id
		);


		$this->smarty->assign(array(
			'documentation_link' => $this->_path.'documentation_en.pdf',
		));

		return $helper->generateForm(array($fields_form)).$this->display(__FILE__, 'views/templates/admin/admin.tpl');

	}

	public function getConfigFieldsValues()
	{
		return array(
			'TWITTLOGIN' => Tools::getValue('TWITTLOGIN', Configuration::get('TWITTLOGIN')),
			'TWITT_HOOK' => Tools::getValue('TWITT_HOOK', Configuration::get('TWITT_HOOK')),
			'NUMBEROFTWITTS' => Tools::getValue('NUMBEROFTWITTS', Configuration::get('NUMBEROFTWITTS')),
			'tw_oauth_access_token' => Tools::getValue('tw_oauth_access_token', Configuration::get('tw_oauth_access_token')),
			'tw_oauth_access_token_secret' => Tools::getValue('tw_oauth_access_token_secret', Configuration::get('tw_oauth_access_token_secret')),
			'tw_consumer_key' => Tools::getValue('tw_consumer_key', Configuration::get('tw_consumer_key')),
			'tw_consumer_secret' => Tools::getValue('tw_consumer_secret', Configuration::get('tw_consumer_secret')),
		);
	}

	public function hookDisplayHeader()
	{
		$this->context->controller->addCSS($this->_path.'views/css/twitterwidget.css', 'all');
		$this->context->controller->addJS($this->_path.'views/js/script.js', 'all');
	}

	public function displayHook($hook_name)
	{
		require_once('twitterapiexchange.php');
		$twittlogin = Configuration::get('TWITTLOGIN');
		$numberoftwitts = Configuration::get('NUMBEROFTWITTS');
		/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
		$settings = array(
			'oauth_access_token' => Configuration::get('tw_oauth_access_token'),
			'oauth_access_token_secret' => Configuration::get('tw_oauth_access_token_secret'),
			'consumer_key' => Configuration::get('tw_consumer_key'),
			'consumer_secret' => Configuration::get('tw_consumer_secret')
		);
		$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$getfield = '?screen_name='.$twittlogin.'&exclude_replies=true&count=3200&include_rts=true';
		$request_method = 'GET';
		if (!function_exists('curl_init')) {
			return '';
		}
		try {
			$twitter = new TwitterAPIExchange($settings);
			$response = $twitter->setGetfield($getfield)->buildOauth($url, $request_method)->performRequest();
		} catch (Exception $e) {
			return '';
		}

		$response = (Tools::jsonDecode($response, true));
		if ($response && count($response)) {
			foreach ($response as &$res) {
				if (isset($res['created_at'])) {
					$res['created_at'] = strtotime($res['created_at']);
					$res['created_at'] = date('d/m/y H:i:s', $res['created_at']);
				}
			}
		}
		$this->context->smarty->assign(
			array(
				'TWITTER_RESPONSE'=>$response,
				'TWITTLOGIN'=>$twittlogin,
				'NUMBOFTWITTS'=>$numberoftwitts,
				'hook_name'=> $hook_name,
				)
		);
		$multilang_array = array();
		foreach ($this->getMultilangFields(true) as $field_name) {
			$key = 'twitt_'.$field_name;
			$multilang_array[$key] = Configuration::get(Tools::strtoupper($key.'_'.$this->context->language->id));
		}
		$this->smarty->assign($multilang_array);
		return $this->display(__FILE__, 'views/templates/hook/twitterwidget.tpl');
	}

	public function hookDisplayTop()
	{
		return $this->displayHook('displayTop');
	}

	public function hookDisplayHome()
	{
		return $this->displayHook('displayHome');
	}

	public function hookDisplayHomeCustom()
	{
		return $this->displayHook('displayHomeCustom');
	}

	public function hookDisplayFooter()
	{
		return $this->displayHook('displayFooter');
	}

	public function hookDisplayTwitter()
	{
		return $this->displayHook('displayTwitter');
	}

	public function hookBackOfficeHeader($params)
	{
		if (Tools::getValue('configure') == $this->name) {
			$this->context->controller->addJquery();
			$this->context->controller->addJS($this->_path.'views/js/admin.js');
			$this->context->controller->addCSS(($this->_path).'views/css/admin.css', 'all');
		}
	}
}
