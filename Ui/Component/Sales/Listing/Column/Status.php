<?php
/**
 * ManiyaTech
 *
 * @author        Milan Maniya
 * @package       ManiyaTech_OrderGrid
 */

namespace ManiyaTech\OrderGrid\Ui\Component\Sales\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use ManiyaTech\OrderGrid\Model\StatusColor;

class Status extends Column
{
    /**
     * @var StatusColor
     */
    protected StatusColor $statusColor;

    /**
     * Status Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param StatusColor $statusColor
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StatusColor $statusColor,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->statusColor = $statusColor;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item['status_color'] = $this->statusColor->getColorByStatus($item[$this->getData('name')]);
            }
        }
        return $dataSource;
    }
}
