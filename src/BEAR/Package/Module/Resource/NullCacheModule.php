<?php
/**
 * This file is part of the BEAR.Packages package
 *
 * @package BEAR.Sunday
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace BEAR\Package\Module\Resource;

use Ray\Di\AbstractModule;


/**
 * Resource null cache module
 *
 * @package    BEAR.Sunday
 * @subpackage Module
 */
class NullCacheModule extends AbstractModule
{
    /**
     * (non-PHPdoc)
     * @see Ray\Di.AbstractModule::configure()
     */
    protected function configure()
    {
        $this->bind('Guzzle\Common\Cache\CacheAdapterInterface')->annotatedWith('resource_cache')->to(
            'Guzzle\Common\Cache\NullCacheAdapter'
        );
    }
}
