<?php
namespace b3nl\Theme\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The new file view finder using the theme model.
 * @author b3nl <code@b3nl.de>
 * @category Facades
 * @package b3nl\Theme
 * @subpackage Facades
 * @version $id$
 */
class Theme extends Facade
{
    /**
     * Get the registered name of the component.
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'theme';
    }
}
