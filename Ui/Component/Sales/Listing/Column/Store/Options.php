<?php
/**
 * ManiyaTech
 *
 * @author        Milan Maniya
 * @package       ManiyaTech_OrderGrid
 */

namespace ManiyaTech\OrderGrid\Ui\Component\Sales\Listing\Column\Store;

use Magento\Framework\Escaper;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Store\Model\System\Store as SystemStore;

class Options implements OptionSourceInterface
{
    /**
     * @var Escaper
     */
    protected $escaper;

    /**
     * @var SystemStore
     */
    protected $systemStore;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var array
     */
    protected $currentOptions = [];

    /**
     * Constructor
     *
     * @param SystemStore $systemStore
     * @param Escaper $escaper
     */
    public function __construct(SystemStore $systemStore, Escaper $escaper)
    {
        $this->systemStore  = $systemStore;
        $this->escaper      = $escaper;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->options !== null) {
            return $this->options;
        }

        $this->generateCurrentOptions();

        $this->options = array_values($this->currentOptions);

        return $this->options;
    }

    /**
     * Generate current options
     *
     * @return void
     */
    protected function generateCurrentOptions()
    {
        $websiteCollection  = $this->systemStore->getWebsiteCollection();
        $groupCollection    = $this->systemStore->getGroupCollection();
        $storeCollection    = $this->systemStore->getStoreCollection();
        /** @var \Magento\Store\Model\Website $website */
        foreach ($websiteCollection as $website) {
            /** @var \Magento\Store\Model\Group $group */
            foreach ($groupCollection as $group) {
                if ($group->getWebsiteId() == $website->getId()) {
                    /** @var  \Magento\Store\Model\Store $store */
                    foreach ($storeCollection as $store) {
                        if ($store->getGroupId() == $group->getId()) {
                            $name = sprintf(
                                '%s/%s',
                                $this->escaper->escapeHtml($website->getName()),
                                $this->escaper->escapeHtml($store->getName())
                            );
                            $this->currentOptions[$name]['label'] = $name;
                            $this->currentOptions[$name]['value'] = $store->getId();
                        }
                    }
                }
            }
        }
    }
}
