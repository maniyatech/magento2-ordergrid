<?php
/**
 * ManiyaTech
 *
 * @author        Milan Maniya
 * @package       ManiyaTech_OrderGrid
 */

namespace ManiyaTech\OrderGrid\Model\ResourceModel\Order\Grid;

use Magento\Sales\Model\ResourceModel\Order\Grid\Collection as SalesOrderGridCollection;
use Zend_Db_Expr;

class Collection extends SalesOrderGridCollection
{
    /**
     * Initialize select with join to sales_order_item.
     *
     * @return $this
     */
    protected function _initSelect()
    {
        parent::_initSelect();

        $this->join(
            [$this->getTable('sales_order_item')],
            "main_table.entity_id = {$this->getTable('sales_order_item')}.order_id",
            []
        );
        $this->getSelect()->group('main_table.entity_id');

        return $this;
    }

    /**
     * Add custom filter logic for purchase_items.
     *
     * @param string|array $field
     * @param null|string|array $condition
     * @return $this
     */
    public function addFieldToFilter($field, $condition = null)
    {
        if (!$this->getFlag('order_items_filter_added') && $field === 'purchase_items') {
            $this->getSelect()->join(
                ['purchase_item_table' => $this->getTable('sales_order_item')],
                "main_table.entity_id = purchase_item_table.order_id",
                []
            );
            $this->getSelect()->group('main_table.entity_id');

            $this->addFieldToFilter(
                [
                    "purchase_item_table.sku",
                    "purchase_item_table.name",
                ],
                [
                    $condition,
                    $condition,
                ]
            );

            $this->setFlag('order_items_filter_added', true);
            return $this;
        }

        return parent::addFieldToFilter($field, $condition);
    }

    /**
     * Load additional order item data after collection load.
     *
     * @return $this
     */
    protected function _afterLoad()
    {
        $items = $this->getColumnValues('entity_id');

        if (count($items)) {
            $connection = $this->getConnection();

            $select = $connection->select()
                ->from([
                    'sales_order_item' => $this->getTable('sales_order_item'),
                ], [
                    'order_id',
                    'item_skus'  => new Zend_Db_Expr('GROUP_CONCAT(`sales_order_item`.sku SEPARATOR "|")'),
                    'item_names' => new Zend_Db_Expr('GROUP_CONCAT(`sales_order_item`.name SEPARATOR "|")'),
                    'item_qtys'  => new Zend_Db_Expr('GROUP_CONCAT(`sales_order_item`.qty_ordered SEPARATOR "|")'),
                ])
                ->where('order_id IN (?)', $items)
                ->where('parent_item_id IS NULL')
                ->group('order_id');

            $items = $connection->fetchAll($select);
            foreach ($items as $item) {
                $row = $this->getItemById($item['order_id']);
                $itemSkus = explode('|', $item['item_skus']);
                $itemQtys = explode('|', $item['item_qtys']);
                $itemNames = explode('|', $item['item_names']);

                $html = '';
                foreach ($itemSkus as $index => $sku) {
                    $html .= sprintf('<div>%d x %s (%s) </div>', $itemQtys[$index], $itemNames[$index], $sku);
                }

                $row->setData('purchase_items', $html);
            }
        }

        return parent::_afterLoad();
    }
}
