<?php
/**
 * ManiyaTech
 *
 * @author        Milan Maniya
 * @package       ManiyaTech_OrderGrid
 */

namespace ManiyaTech\OrderGrid\Block\Adminhtml\System\Config\Form\Field;

use Magento\Framework\View\Element\AbstractBlock;

class ColorColumn extends AbstractBlock
{
    /**
     * Render the HTML input and attach a jQuery ColorPicker.
     *
     * @return string
     */
    protected function _toHtml()
    {
        $html = '<input type="text" name="' . $this->getInputName() . '" id="' . $this->getInputId() . '">';
        $html .= '<script type="text/javascript">
            require(["jquery","domReady!", "jquery/colorpicker/js/colorpicker"], function ($) {
                var $colorElement = $("#'.$this->getInputId().'");
                $colorElement.css("background", $colorElement.val());
                $colorElement.ColorPicker({
                    onChange: function (hsb, hex, rgb) {
                        $colorElement.css("backgroundColor", "#" + hex).val("#" + hex);
                    }
                });
            });
            </script>';
        return $html;
    }
}
