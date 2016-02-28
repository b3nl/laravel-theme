<?php
namespace b3nl\Theme\Http\Middleware;

use Closure;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Theme;

/**
 * Middleware which loads the theme for the given route.
 * @author b3nl <code@b3nl.de>
 * @category Middleware
 * @package b3nl\Theme
 * @subpackage Http\Middleware
 * @version $id$
 */
class ThemeMiddleware
{
    /**
     * The injected file system.
     * @var Filesystem
     */
    protected $filesystem = null;

    /**
     * ThemeMiddleware constructor.
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->setFilesystem($filesystem);
    }

    /**
     * Returns the filesystem instance.
     * @return Filesystem
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  Closure $next
     * @param  string $themeId The theme id.
     * @return mixed
     */
    public function handle($request, Closure $next, $themeId)
    {
        if ($themeId) {
            $this->loadTheme($themeId);
        }

        return $next($request);
    }

    /**
     * Loads the theme with the given id.
     * @param string $themeId
     * @return ThemeMiddleware
     */
    protected function loadTheme($themeId)
    {
        if ($themeId) {
            Theme::setId($themeId);

            $themeLoader = resource_path($themeId . DIRECTORY_SEPARATOR . 'theme.php');

            if ($this->getFilesystem()->exists($themeLoader)) {
                include $themeLoader;
            }
        }

        return $this;
    }

    /**
     * Sets the file system instance.
     * @param Filesystem $filesystem
     * @return ThemeMiddleware
     */
    public function setFilesystem(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;

        return $this;
    }
}
