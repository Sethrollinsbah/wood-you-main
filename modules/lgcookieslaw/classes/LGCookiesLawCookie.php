<?php
/**
 *  Please read the terms of the CLUF license attached to this module(cf "licences" folder)
 *
 * @author    Línea Gráfica E.C.E. S.L.
 * @copyright Lineagrafica.es - Línea Gráfica E.C.E. S.L. all rights reserved.
 * @license   https://www.lineagrafica.es/licenses/license_en.pdf
 *            https://www.lineagrafica.es/licenses/license_es.pdf
 *            https://www.lineagrafica.es/licenses/license_fr.pdf
 */

class LGCookiesLawCookie extends ObjectModel
{
    public $id_shop;
    public $id_lgcookieslaw_purpose;
    public $name;
    public $provider;
    public $provider_url;
    public $active = true;
    public $date_add;
    public $date_upd;

    public $cookie_purpose;
    public $expiry_time;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = [
        'table' => 'lgcookieslaw_cookie',
        'primary' => 'id_lgcookieslaw_cookie',
        'multilang' => true,
        'fields' => [
            'id_shop' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId'],
            'id_lgcookieslaw_purpose' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId'],
            'name' => ['type' => self::TYPE_STRING, 'size' => 64, 'required' => true],
            'provider' => ['type' => self::TYPE_STRING],
            'provider_url' => ['type' => self::TYPE_STRING, 'validate' => 'isAbsoluteUrl'],
            'active' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true],
            'date_add' => ['type' => self::TYPE_DATE, 'validate' => 'isDate', 'copy_post' => false],
            'date_upd' => ['type' => self::TYPE_DATE, 'validate' => 'isDate', 'copy_post' => false],

            'cookie_purpose' => ['type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml'],
            'expiry_time' => ['type' => self::TYPE_STRING, 'lang' => true],
        ],
    ];

    public static function getInstallationDefaults()
    {
        $installation_defaults = [
            LGCookiesLawPurpose::FUNCTIONAL_PURPOSE => [
                [
                    'active' => false,
                    'name' => 'PHP_SESSID',
                    'provider' => Tools::getHttpHost(),
                    'provider_url' => '',
                    'cookie_purpose' => [
                        'es' => 'La cookie PHPSESSID es nativa de PHP y permite a los sitios web almacenar datos de ' .
                            'estado serializados. En el sitio web se utiliza para establecer una sesión de usuario y ' .
                            'para pasar los datos de estado a través de una cookie temporal, que se conoce ' .
                            'comúnmente como una cookie de sesión. Estas Cookies solo permanecerán en su ' .
                            'equipo hasta que cierre el navegador.',
                        'en' => 'The PHPSESSID cookie is native to PHP and allows websites to store serialised ' .
                            'status data. On the website it is used to establish a user session and to pass state ' .
                            'data through a temporary cookie, which is commonly known as a session cookie. These ' .
                            'Cookies will only remain on your computer until you close your browser.',
                        'fr' => 'Le cookie PHPSESSID est natif de PHP et permet aux sites web de stocker des ' .
                            'données d\'état sérialisées. Sur le site web, il est utilisé pour établir une ' .
                            'session d\'utilisateur et pour transmettre des données d\'état par le biais d\'un ' .
                            'cookie temporaire, communément appelé cookie de session. Ces cookies ne resteront ' .
                            'sur votre ordinateur que jusqu\'à ce que vous fermiez votre navigateur.',
                        'pl' => 'Plik cookie PHPSESSID jest natywny dla PHP i umożliwia stronom internetowym ' .
                            'przechowywanie zserializowanych danych o stanie. Na stronie internetowej służy do ' .
                            'ustanowienia sesji użytkownika i przekazania danych o stanie poprzez tymczasowe ' .
                            'ciasteczko, które jest powszechnie znane jako ciasteczko sesyjne. Te pliki cookie ' .
                            'pozostaną na Twoim komputerze tylko do momentu zamknięcia przeglądarki.',
                        'pt' => 'O cookie PHPSESSID é nativo de PHP e permite que os websites armazenem dados de ' .
                            'estado seriados. No sítio web é utilizado para estabelecer uma sessão do utilizador e ' .
                            'para passar dados de estado através de um cookie temporário, que é vulgarmente ' .
                            'conhecido como cookie de sessão. Estes Cookies só permanecerão no seu computador até ' .
                            'que feche o seu navegador.',
                        'nl' => 'De PHPSESSID-cookie is native voor PHP en stelt websites in staat om ' .
                            'geserialiseerde statusgegevens op te slaan. Op de website wordt het gebruikt om ' .
                            'een gebruikerssessie tot stand te brengen en om statusgegevens door te geven via ' .
                            'een tijdelijke cookie, die algemeen bekend staat als een sessiecookie. Deze cookies ' .
                            'blijven alleen op uw computer totdat u de browser sluit.',
                        'de' => 'Das PHPSESSID-Cookie ist PHP nativ und ermöglicht es Websites, serialisierte ' .
                            'Statusdaten zu speichern. Auf der Website wird es verwendet, um eine Benutzersitzung ' .
                            'aufzubauen und Statusdaten durch ein temporäres Cookie zu übergeben, das allgemein als ' .
                            'Sitzungscookie bekannt ist. Diese Cookies verbleiben nur auf Ihrem Computer, bis Sie ' .
                            'den Browser schließen.',
                        'it' => 'Il cookie PHPSESSID è nativo di PHP e permette ai siti web di memorizzare dati di ' .
                            'stato serializzati. Sul sito web viene utilizzato per stabilire una sessione ' .
                            'dell\'utente e per passare dati di stato attraverso un cookie temporaneo, comunemente ' .
                            'noto come cookie di sessione. Questi cookie rimarranno sul suo computer solo fino ' .
                            'alla chiusura del suo browser.',
                        'gb' => 'The PHPSESSID cookie is native to PHP and allows websites to store serialised ' .
                            'status data. On the website it is used to establish a user session and to pass state ' .
                            'data through a temporary cookie, which is commonly known as a session cookie. These ' .
                            'Cookies will only remain on your computer until you close your browser.',
                    ],
                    'expiry_time' => [
                        'es' => 'Sesión',
                        'en' => 'Session',
                        'fr' => 'Session',
                        'pl' => 'Sesja',
                        'pt' => 'Sessão',
                        'nl' => 'Sessie',
                        'de' => 'Sitzung',
                        'it' => 'Sessione',
                        'gb' => 'Session',
                    ],
                ],
                [
                    'active' => true,
                    'name' => 'PrestaShop-#',
                    'provider' => Tools::getHttpHost(),
                    'provider_url' => '',
                    'cookie_purpose' => [
                        'es' => 'Se trata de una cookie que usa Prestashop para guardar información y mantener ' .
                            'abierta la sesión del usuario. Permite guardar información como la divisa, el ' .
                            'idioma, identificador del cliente, entre otros datos necesarios para el ' .
                            'correcto funcionamiento de la tienda.',
                        'en' => 'This is a cookie used by Prestashop to store information and keep the user\'s ' .
                            'session open. It stores information such as currency, language, customer ID, among ' .
                            'other data necessary for the proper functioning of the shop.',
                        'fr' => 'Il s\'agit d\'un cookie utilisé par Prestashop pour stocker des informations et ' .
                            'garder la session de l\'utilisateur ouverte. Il stocke des informations telles que ' .
                            'la devise, la langue, l\'identifiant du client, entre autres données nécessaires au ' .
                            'bon fonctionnement de la boutique.',
                        'pl' => 'Jest to plik cookie, którego Prestashop używa do zapisywania informacji i ' .
                            'utrzymywania otwartej sesji użytkownika. Umożliwia zapisywanie informacji takich jak ' .
                            'waluta, język, identyfikator klienta między innymi danymi niezbędnymi do ' .
                            'prawidłowego funkcjonowania sklepu.',
                        'pt' => 'Este é um cookie utilizado pela Prestashop para armazenar informação e manter a ' .
                            'sessão do utilizador aberta. Armazena informações tais como moeda, língua, ' .
                            'identificação do cliente, entre outros dados necessários para o bom funcionamento da ' .
                            'loja.',
                        'nl' => 'Het is een cookie die Prestashop gebruikt om informatie op te slaan en de sessie ' .
                            'van de gebruiker open te houden. Hiermee kunt u informatie opslaan zoals valuta, ' .
                            'taal, klantidentificatie en andere gegevens die nodig zijn voor de goede werking ' .
                            'van de winkel.',
                        'de' => 'Es ist ein Cookie, das Prestashop verwendet, um Informationen zu speichern und die ' .
                            'itzung des Benutzers offen zu halten. Ermöglicht das Speichern von Informationen wie ' .
                            'Währung, Sprache, Kundenkennung und anderen Daten, die für das ordnungsgemäße ' .
                            'Funktionieren des Shops erforderlich sind.',
                        'it' => 'Questo è un cookie utilizzato da Prestashop per memorizzare informazioni e ' .
                            'mantenere aperta la sessione dell\'utente. Memorizza informazioni come la valuta, ' .
                            'la lingua, l\'ID del cliente, tra gli altri dati necessari per il corretto ' .
                            'funzionamento del negozio.',
                        'gb' => 'This is a cookie used by Prestashop to store information and keep the user\'s ' .
                            'session open. It stores information such as currency, language, customer ID, among ' .
                            'other data necessary for the proper functioning of the shop.',
                    ],
                    'expiry_time' => [
                        'es' => Configuration::get('PS_COOKIE_LIFETIME_FO') . ' horas',
                        'en' => Configuration::get('PS_COOKIE_LIFETIME_FO') . ' hours',
                        'fr' => Configuration::get('PS_COOKIE_LIFETIME_FO') . ' heures',
                        'pl' => Configuration::get('PS_COOKIE_LIFETIME_FO') . ' godziny',
                        'pt' => Configuration::get('PS_COOKIE_LIFETIME_FO') . ' horas',
                        'nl' => Configuration::get('PS_COOKIE_LIFETIME_FO') . ' uren',
                        'de' => Configuration::get('PS_COOKIE_LIFETIME_FO') . ' stunden',
                        'it' => Configuration::get('PS_COOKIE_LIFETIME_FO') . ' ore',
                        'gb' => Configuration::get('PS_COOKIE_LIFETIME_FO') . ' hours',
                    ],
                ],
            ],
        ];

        return $installation_defaults;
    }
}
