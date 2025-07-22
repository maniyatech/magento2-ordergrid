<?php
/**
 * ManiyaTech
 *
 * @author        Milan Maniya
 * @package       ManiyaTech_OrderGrid
 */

namespace ManiyaTech\OrderGrid\Model;

use Magento\Framework\Serialize\Serializer\Json as JsonSerializer;

class StatusColor
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var JsonSerializer
     */
    private $jsonSerializer;

    /**
     * @var array
     */
    private $configValues;

    /**
     * Config constructor.
     *
     * @param Config $config
     * @param JsonSerializer $jsonSerializer
     */
    public function __construct(
        Config $config,
        JsonSerializer $jsonSerializer
    ) {
        $this->config = $config;
        $this->jsonSerializer = $jsonSerializer;
    }

    /**
     * Get color for a given order status.
     *
     * @param string $status
     * @return string
     */
    public function getColorByStatus($status): string
    {
        $configValues = $this->getConfigValues();
        $defaultValue = 'transparent';
        if (empty($configValues)) {
            return $defaultValue;
        }
        $value = $defaultValue;
        foreach ($configValues as $data) {
            if ($data['order_status'] == $status) {
                $value = $data['color'];
                break;
            }
        }
        return $value;
    }

    /**
     * Retrieve configured order status color values.
     *
     * @return array
     */
    public function getConfigValues(): array
    {
        if (!$this->configValues) {
            $configValues = $this->config->getGridStatusColor();
            if (empty($configValues)) {
                return $this->configValues = [];
            }
            if (is_array($configValues)) {
                return $this->configValues = $configValues;
            }
            $this->configValues = $this->jsonSerializer->unserialize($configValues);
        }

        return $this->configValues;
    }
}
