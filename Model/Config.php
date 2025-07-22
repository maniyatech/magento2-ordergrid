<?php
/**
 * ManiyaTech
 *
 * @author        Milan Maniya
 * @package       ManiyaTech_OrderGrid
 */

namespace ManiyaTech\OrderGrid\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config implements ConfigInterface
{
    /**
     * Default text format for amount display.
     */
    public const DEFAULT_AMOUNT_DISPLAY_TEXT = '| Total amount {{amount}}';

    /**
     * XML config paths.
     */
    public const XML_PATH_ENABLED                        = 'ordergrid/general/enabled';
    public const XML_PATH_GRID_AMOUNT_DISPLAY_TEXT       = 'ordergrid/grid/amount_display_text';
    public const XML_PATH_GRID_AMOUNT_DISPLAY_ROUNDING   = 'ordergrid/grid/amount_display_rounding';
    public const XML_PATH_GRID_VISIBLE_PURCHASE_ITEMS    = 'ordergrid/grid/visible_purchase_items';
    public const XML_PATH_GRID_STATUS_COLOR              = 'ordergrid/grid/status_color';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Config constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Check if a flag is set for a given config path.
     *
     * @param string $xmlPath
     * @return bool
     */
    public function getConfigFlag($xmlPath)
    {
        return $this->scopeConfig->isSetFlag(
            $xmlPath,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get a config value for a given path.
     *
     * @param string $xmlPath
     * @return mixed
     */
    public function getConfigValue($xmlPath)
    {
        return $this->scopeConfig->getValue(
            $xmlPath,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check if the module is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->getConfigFlag(self::XML_PATH_ENABLED);
    }

    /**
     * Alias for isEnabled().
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->isEnabled();
    }

    /**
     * Get the configured display text for total amount.
     *
     * @return string
     */
    public function getAmountDisplayText()
    {
        $text = $this->getConfigValue(self::XML_PATH_GRID_AMOUNT_DISPLAY_TEXT);
        if (empty($text) || strpos($text, '{{amount}}') === false) {
            return self::DEFAULT_AMOUNT_DISPLAY_TEXT;
        }
        return $text;
    }

    /**
     * Determine if amount display rounding is enabled.
     *
     * @return bool
     */
    public function getAmountDisplayRounding()
    {
        return $this->getConfigFlag(self::XML_PATH_GRID_AMOUNT_DISPLAY_ROUNDING);
    }

    /**
     * Get visibility status of purchase items in the grid.
     *
     * @return bool
     */
    public function getVisiblePurchaseItems()
    {
        return $this->getConfigFlag(self::XML_PATH_GRID_VISIBLE_PURCHASE_ITEMS);
    }

    /**
     * Get color settings for different order statuses.
     *
     * @return mixed
     */
    public function getGridStatusColor()
    {
        return $this->getConfigValue(self::XML_PATH_GRID_STATUS_COLOR);
    }
}
