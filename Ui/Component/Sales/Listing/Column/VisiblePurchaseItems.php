<?php
/**
 * ManiyaTech
 *
 * @author        Milan Maniya
 * @package       ManiyaTech_OrderGrid
 */

namespace ManiyaTech\OrderGrid\Ui\Component\Sales\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponentFactory;
use ManiyaTech\OrderGrid\Model\Config as OrderGridConfig;

class VisiblePurchaseItems extends Column
{
    /**
     * @var OrderGridConfig
     */
    protected $orderGridConfig;

    /**
     * Visible Purchase Items constructor.
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param OrderGridConfig $orderGridConfig
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        OrderGridConfig $orderGridConfig,
        array $components = [],
        array $data = []
    ) {
        $this->orderGridConfig = $orderGridConfig;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Modify column configuration based on system config
     */
    public function prepare()
    {
        $enabled = $this->orderGridConfig->isActive();
        $showColumn = $this->orderGridConfig->getVisiblePurchaseItems();

        if (!$enabled || !$showColumn) {
            $this->_data['config']['componentDisabled'] = true;
        }

        parent::prepare();
    }
}
