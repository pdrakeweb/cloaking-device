<?php
namespace CloakingDevice;

use stdClass;

/**
 * Provides an on-demand object injector.
 */
class Cloak extends stdClass
{

    /**
     * Contains the injected object.
     *
     * @var stdClass
     */
    protected $object;

    /**
     * Indicates whether the object has been fully loaded.
     *
     * @var bool
     */
    protected $loaded = false;


    /**
     * Stores NULL in a variable for return by reference.
     *
     * @var NULL
     */
    public $_null_value = null;

    /**
     * Build the object.
     */
    public function __construct()
    {
          $this->object = new stdClass();
    }

    /**
     * Implementation of the magic __get method.
     *
     * @param string $requested_property
     * @return mixed
     */
    public function &__get($requested_property)
    {
        // If the property is not set and we aren't fully loaded, attempt to load
        // the property directly or via node_load.
        if (!isset($this->object->$requested_property) && !$this->loaded) {
            $this->load();
        }

        if (isset($this->object->$requested_property)) {
            return $this->object->$requested_property;
        } else {
            return $this->_null_value;
        }
    }

    /**
     * Implements the magic __set method.
     *
     * @param string $set_property
     * @param mixed $value
     */
    public function __set($set_property, $value)
    {
        $this->object->$set_property = $value;
    }

    /**
     * Implements the magic __isset method.
     *
     * @param string $property
     */
    public function __isset($property)
    {
        return ($this->__get($property) !== null);
    }

    /**
     * Implements the magic __unset method.
     *
     * @param string $property
     */
    public function __unset($property)
    {
        unset($this->object->$property);
    }

    /**
     * Helper function to load the object.
     */
    protected function load()
    {
        $this->loaded = true;
    }
}
