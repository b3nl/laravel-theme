<?php
namespace b3nl\Theme\Theme;

use b3nl\Theme\Facades\Theme;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\FileViewFinder as BaseClass;

/**
 * The new file view finder using the theme model.
 * @author b3nl <code@b3nl.de>
 * @category Middleware
 * @package b3nl\Theme
 * @subpackage Http\Middleware
 * @version $id$
 */
class FileViewFinder extends BaseClass
{
    /**
     * Create a new file view loader instance.
     * @param  Filesystem  $files
     * @param  array  $extensions
     */
    public function __construct(Filesystem $files, array $extensions = null)
    {
        $this->files = $files;

        if (isset($extensions)) {
            $this->extensions = $extensions;
        }
    }

    /**
     * Get the fully qualified location of the view.
     * @param  string  $name
     * @return string
     * @todo Add more checks for the theme.
     */
    public function find($name)
    {
        if (isset($this->views[$name])) {
            return $this->views[$name];
        }

        if ($this->hasHintInformation($name = trim($name))) {
            return $this->views[$name] = $this->findNamedPathView($name);
        }

        return $this->views[$name] = $this->findInPaths($name, [Theme::getDir()]);
    }
}
