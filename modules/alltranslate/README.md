# All Translate

v1.0.0

Translates custom themes and modules into one or more languages. Translation is powered by [Yandex.Translate](http://translate.yandex.com/).

## Installation

_All Translate_ is installed like any other module. Simply upload your archive to install it.

## Configuration

In order to use the module, you need a free Yandex API key. Get one by visiting [api.yandex.com](http://api.yandex.com/key/form.xml?service=trnsl). After you have acquired a key, enter it into the _API Key_ field on the module configuration page.

## Usage

_All translate_ can translate installed themes and modules that support the new translation system introduced in PrestaShop 1.7. Translation options are specified on the control panel. In order to translate into multiple languages, check the _Translate into multiple languages_ checkbox and select desired languages by simultaneously pressing __Ctrl__ button and clicking on their names. Alternatively, if you want to translate a theme/module into all available languages, choose _All_ from the target language drop-down list (it’s the last item).

_Please note that although source language can also be specified, in order to be able to translate from a language other than English, your theme/module must be already completely translated into that language. Use this feature only if the default language of the theme/module you are translating is not English._

_Overwrite existing translations_ checkbox controls whether existing translations will be overwritten. Uncheck it to only add missing translations. If this checkbox is activated, _All translate_ will additionally translate names of shop pages and data created by several commonly used built-in PrestaShop modules.

To translate a single theme or module, click the __Translate__ button to the right of its name. You can translate multiple items at once. To do that, check the checkboxes to the left of themes/modules you want to translate, click the __Bulk actions__ button at the bottom of the configuration page and choose _Translate selected_.

## License

This module is licensed under [Academic Free License (AFL 3.0)](https://opensource.org/licenses/afl-3.0.php).