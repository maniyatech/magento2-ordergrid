<?php
/**
 * ManiyaTech
 *
 * @author        Milan Maniya
 * @package       ManiyaTech_OrderGrid
 */

namespace ManiyaTech\OrderGrid\Model;

interface ConfigInterface
{
    /**
     * Get configuration boolean value
     *
     * @param string $xmlPath
     * @return bool
     */
    public function getConfigFlag($xmlPath);

    /**
     * Get configuration value
     *
     * @param string $xmlPath
     * @return string
     */
    public function getConfigValue($xmlPath);
}
