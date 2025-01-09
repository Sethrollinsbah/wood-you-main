<?php
/**
 * GIFT CARD
 *
 *    @author    EIRL Timactive De Véra
 *    @copyright Copyright (c) TIMACTIVE 2015 -EIRL Timactive De Véra
 *    @license   Commercial license
 *    @category pricing_promotion
 *    @version 1.1.0
 *
 *************************************
 **         GIFT CARD                *
 **          V 1.0.0                 *
 *************************************
 * +
 * + Languages: EN, FR, ES
 * + PS version: 1.5,1.6,1.7
 */

if (version_compare(_PS_VERSION_, '1.7.0.0', '<')) {
    require_once(_PS_TOOL_DIR_.'tcpdf/config/lang/eng.php');
}
if (! class_exists('TCPDF')) {
    require_once(_PS_TOOL_DIR_.'tcpdf/tcpdf.php');
}

/**
 *
 * @since 1.5
 */
class PDFGiftCard extends TCPDF
{

    const DEFAULT_FONT = 'helvetica';

    public $header;

    public $footer;

    public $content;

    public $font;

    public $font_by_lang = array(
        'ja' => 'cid0jp',
        'bg' => 'freeserif',
        'ru' => 'freeserif',
        'uk' => 'freeserif',
        'mk' => 'freeserif',
        'el' => 'freeserif',
        'en' => 'dejavusans',
        'lt' => 'dejavusans',
        'vn' => 'dejavusans',
        'pl' => 'dejavusans',
        'ar' => 'dejavusans',
        'fa' => 'dejavusans',
        'ur' => 'dejavusans',
        'az' => 'dejavusans',
        'ro' => 'dejavusans',
        'ca' => 'dejavusans',
        'gl' => 'dejavusans',
        'hr' => 'dejavusans',
        'sr' => 'dejavusans',
        'si' => 'dejavusans',
        'cs' => 'dejavusans',
        'sk' => 'dejavusans',
        'ka' => 'dejavusans',
        'he' => 'dejavusans',
        'lo' => 'dejavusans',
        'lv' => 'dejavusans',
        'tr' => 'dejavusans',
        'ko' => 'cid0kr',
        'ro' => 'freeserif',
        'zh' => 'cid0cs',
        'tw' => 'cid0cs',
        'th' => 'freeserif'
    );

    public function __construct($use_cache = false)
    {
        parent::__construct('P', 'mm', 'A4', true, 'UTF-8', $use_cache, false);
    }

    /**
     * set the PDF encoding
     *
     * @param string $encoding
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;
    }

    /**
     *
     *
     *
     * set the PDF header
     *
     * @param string $header
     *            HTML
     */
    public function createHeader($header)
    {
        $this->header = $header;
    }

    /**
     *
     *
     *
     * set the PDF footer
     *
     * @param string $footer
     *            HTML
     */
    public function createFooter($footer)
    {
        $this->footer = $footer;
    }

    /**
     *
     *
     *
     * create the PDF content
     *
     * @param string $content
     *            HTML
     */
    public function createContent($content)
    {
        $this->content = $content;
    }

    /**
     * Change the font
     *
     * @param string $iso_lang
     */
    public function setFontForLang($iso_lang)
    {
        $this->font = PDFGenerator::DEFAULT_FONT;
        if (array_key_exists($iso_lang, $this->font_by_lang)) {
            $this->font = $this->font_by_lang[$iso_lang];
        }
        $this->setHeaderFont(array(
            $this->font,
            '',
            PDF_FONT_SIZE_MAIN
        ));
        $this->setFooterFont(array(
            $this->font,
            '',
            PDF_FONT_SIZE_MAIN
        ));
        $this->setFont($this->font);
    }

    /**
     * Render the pdf file
     *
     * @param string $filename
     * @param $display :
     *            true:display to user, false:save, 'I','D','S' as fpdf display
     * @throws PrestaShopException
     */
    public function render($filename, $display = true)
    {
        if (empty($filename)) {
            throw new PrestaShopException('Missing filename.');
        }
        $this->lastPage();
        if ($display === true) {
            $output = 'D';
        } elseif ($display === false) {
            $output = 'S';
        } elseif ($display == 'D') {
            $output = 'D';
        } elseif ($display == 'S') {
            $output = 'S';
        } else {
            $output = 'I';
        }
        if (ob_get_length() > 0) {
            ob_clean();
        }
        return $this->output($filename, $output);
    }

    /**
     * Write a PDF page
     */
    public function writePage()
    {
        $this->SetHeaderMargin(0);
        $this->SetFooterMargin(0);
        $this->setPrintHeader(false);
        $this->setPrintFooter(false);
        $this->setMargins(10, 10, 10);
        // $img_file = "/home/rdevera/Downloads/splashbg.jpg";
        $this->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $this->AddPage();
        // $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        $this->writeHTML($this->content, true, false, true, false, '');
    }

    /**
     * Override of TCPDF::getRandomSeed() - getmypid() is blocked on several hosting
     */
    protected function getRandomSeed($seed = '')
    {
        $seed .= microtime();
        if (function_exists('openssl_random_pseudo_bytes') &&
            (Tools::strtoupper(Tools::substr(PHP_OS, 0, 3)) !== 'WIN')) {
            // this is not used on windows systems because it is very slow for a know bug
            $seed .= openssl_random_pseudo_bytes(512);
        } else {
            for ($i = 0; $i < 23; ++ $i) {
                $seed .= uniqid('', true);
            }
        }
        $seed .= uniqid('', true);
        $seed .= rand();
        $seed .= __FILE__;
        $seed .= $this->bufferlen;
        if (isset($_SERVER['REMOTE_ADDR'])) {
            $seed .= $_SERVER['REMOTE_ADDR'];
        }
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $seed .= $_SERVER['HTTP_USER_AGENT'];
        }
        if (isset($_SERVER['HTTP_ACCEPT'])) {
            $seed .= $_SERVER['HTTP_ACCEPT'];
        }
        if (isset($_SERVER['HTTP_ACCEPT_ENCODING'])) {
            $seed .= $_SERVER['HTTP_ACCEPT_ENCODING'];
        }
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $seed .= $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        }
        if (isset($_SERVER['HTTP_ACCEPT_CHARSET'])) {
            $seed .= $_SERVER['HTTP_ACCEPT_CHARSET'];
        }
        $seed .= rand();
        $seed .= uniqid('', true);
        $seed .= microtime();
        return $seed;
    }
}
