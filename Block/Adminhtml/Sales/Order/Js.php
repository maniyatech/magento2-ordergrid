<?php
/**
 * ManiyaTech
 *
 * @author        Milan Maniya
 * @package       ManiyaTech_OrderGrid
 */

namespace ManiyaTech\OrderGrid\Block\Adminhtml\Sales\Order;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use ManiyaTech\OrderGrid\Model\Config as ConfigModel;

class Js extends Template
{
    /**
     * Template file for this block.
     *
     * @var string
     */
    protected $_template = 'ManiyaTech_OrderGrid::sales/order/js.phtml';

    /**
     * @var ConfigModel
     */
    private $configModel;

    /**
     * Js constructor.
     *
     * @param Context $context
     * @param ConfigModel $configModel
     * @param array $data
     */
    public function __construct(
        Context $context,
        ConfigModel $configModel,
        array $data = []
    ) {
        $this->configModel = $configModel;
        parent::__construct($context, $data);
    }

    /**
     * Renders the block HTML if the feature is active.
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (!$this->isActive()) {
            return '';
        }

        return parent::_toHtml();
    }

    /**
     * Checks if the module feature is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->configModel->isActive();
    }

    /**
     * Retrieves the base currency symbol for the current store.
     *
     * @return string
     */
    public function getBaseCurrencySymbol()
    {
        return $this->_storeManager->getStore()->getBaseCurrency()->getCurrencySymbol();
    }

    /**
     * Retrieves the configured display text for total amount.
     *
     * @return string
     */
    public function getAmountDisplayText()
    {
        return $this->configModel->getAmountDisplayText();
    }

    /**
     * Checks if amount rounding is enabled.
     *
     * @return bool
     */
    public function getAmountDisplayRounding()
    {
        return $this->configModel->getAmountDisplayRounding();
    }

    /**
     * Returns an array of config values used by JS on the order grid.
     *
     * @return array
     */
    public function getGridConfig()
    {
        return [
            'is_active'                => $this->isActive(),
            'base_currency_symbol'     => $this->getBaseCurrencySymbol(),
            'amount_display_text'      => $this->getAmountDisplayText(),
            'amount_display_rounding'  => $this->getAmountDisplayRounding()
        ];
    }
}
