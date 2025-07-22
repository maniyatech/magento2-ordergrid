<?php
/**
 * ManiyaTech
 *
 * @author        Milan Maniya
 * @package       ManiyaTech_OrderGrid
 */

namespace ManiyaTech\OrderGrid\Block\Adminhtml\System\Config\Form\Field;

use Magento\Framework\View\Element\Html\Select;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Model\ResourceModel\Order\Status\Collection as OrderStatusCollection;

class OrderStatusColumn extends Select
{
    /**
     * @var OrderStatusCollection
     */
    private $orderStatusCollection;

    /**
     * OrderStatusColumn constructor.
     *
     * @param Context $context
     * @param OrderStatusCollection $orderStatusCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        OrderStatusCollection $orderStatusCollection,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->orderStatusCollection = $orderStatusCollection;
    }

    /**
     * Set "name" for <select> element
     *
     * @param string $value
     * @return $this
     */
    public function setInputName(string $value)
    {
        return $this->setName($value);
    }

    /**
     * Set "id" for <select> element
     *
     * @param string $value
     * @return $this
     */
    public function setInputId(string $value)
    {
        return $this->setId($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml(): string
    {
        if (!$this->getOptions()) {
            $this->setOptions($this->getSourceOptions());
        }
        return parent::_toHtml();
    }

    /**
     * Get source array
     *
     * @return array
     */
    private function getSourceOptions(): array
    {
        return $this->orderStatusCollection->toOptionArray();
    }
}
