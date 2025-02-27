<?php
/**
 *    This file is part of eMagicOne Store Manager Bridge Connector.
 *
 *   eMagicOne Store Manager Bridge Connector is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   eMagicOne Store Manager Bridge Connector is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with eMagicOne Store Manager Bridge Connector. If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    eMagicOne <contact@emagicone.com>
 * @copyright 2014-2022 eMagicOne
 * @license   http://www.gnu.org/licenses   GNU General Public License
 */

class MAOrderPDF extends PDFCore
{
    private $languageIsoCode;

    /**
     * MAOrderPDF constructor.
     * @param $languageIsoCode
     * @param $objects
     * @param $template
     * @param $smarty
     */

    public function __construct($languageIsoCode, $objects, $template, $smarty)
    {
        $this->languageIsoCode = $languageIsoCode;
        parent::__construct($objects, $template, $smarty);
    }

    public function render($display = 'D')
    {
        $render = false;
        $this->pdf_renderer->setFontForLang($this->languageIsoCode);

        foreach ($this->objects as $object) {
            $template = $this->getTemplateObject($object);

            if (!$template) {
                break;
            }

            if (empty($this->filename)) {
                $this->filename = $template->getFilename();
            }

            $this->pdf_renderer->createHeader($template->getHeader());
            $this->pdf_renderer->createFooter($template->getFooter());
            $this->pdf_renderer->createContent($template->getContent());
            $this->pdf_renderer->writePage();
            $render = true;
            unset($template);
        }

        if ($render) {
            $this->pdf_renderer->Output($this->filename, $display);
            return true;
        }

        return false;
    }
}
