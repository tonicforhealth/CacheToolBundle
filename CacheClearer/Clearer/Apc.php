<?php

/**
 * Created by PhpStorm.
 * User: Yuriy Maksimenko <yuriy.maksimenko@tonicforhealth.com>
 * Date: 3/21/16
 * Time: 2:17 PM
 */
namespace CacheTool\Bundle\CacheClearer\Clearer;

use CacheTool\CacheTool;

/**
 * Class Apc
 */
class Apc implements ClearerInterface
{
    /**
     * @var CacheTool
     */
    protected $cacheTool;

    /**
     * @var boolean
     */
    protected $apcEnabled;

    /**
     * Opcache constructor.
     *
     * @param CacheTool $cacheTool
     * @param bool      $apcEnabled
     */
    public function __construct(CacheTool $cacheTool, $apcEnabled)
    {
        $this->cacheTool = $cacheTool;
        $this->apcEnabled = $apcEnabled;
    }

    /**
     * Check if cache enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return ($this->apcEnabled) ? true : false;
    }

    /**
     * Clears APC cache
     *
     * @return bool or \RuntimeException
     */
    public function clear()
    {
        $status = $this->cacheTool->apc_clear_cache();

        if (!$status) {
            throw new \RuntimeException('opcache_reset(): No Apc status info available. Probably apc.enabled=0 in php.ini. Please disable apc in your config.yml to avoid this exception');
        }

        return $status;
    }

}
