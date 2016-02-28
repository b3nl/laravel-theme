<?php
namespace b3nl\Theme;

use Closure;

/**
 * The theme model.
 * @author b3nl <code@b3nl.de>
 * @category Model
 * @package b3nl\Theme
 * @version $id$
 */
class Theme
{
    /**
     * The resource dir for this theme.
     * @var mixed
     */
    protected $dir = '';

    /**
     * The id of this theme.
     *
     * The id needs to match the main theme directory.
     * @var string
     */
    protected $id = '';

    /**
     * Was this theme loaded?
     * @var bool
     */
    protected $isLoaded = false;

    /**
     * Returns the resource dir for this theme.
     * @return mixed
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * Returns the of this theme.
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Was this theme loaded?
     * @param bool $newStatus The new status if given.
     * @return bool Returns the old status.
     */
    public function isLoaded($newStatus = false)
    {
        $oldStatus = $this->isLoaded;

        if (func_num_args()) {
            $this->isLoaded = $newStatus;
        } // if

        return $oldStatus;
    } // function

    /**
     * Processes the load callback for the actual theme.
     * @param Closure $loadingFunction
     * @return Theme
     */
    public function load(Closure $loadingFunction)
    {
        $this->isLoaded(true);

        app()->call($loadingFunction, [$this]);
    } // function

    /**
     * Sets the resource dir for this theme.
     * @param mixed $dir
     * @return Theme
     */
    public function setDir($dir)
    {
        $this->dir = $dir;

        return $this;
    } // function

    /**
     * Sets the id of this theme.
     * @param string $id
     * @return Theme
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
