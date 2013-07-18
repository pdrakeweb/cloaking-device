<?php
namespace CloakingDevice\Drupal;

use CloakingDevice\Cloak as Cloak;
use stdClass;

/**
 * Provides an on-demand group node object injector.
 */
class DrupalCloak extends Cloak
{

    /**
     * Build the object.
     *
     * @param mixed $id
     *   The id of the object you wish to cloak.
     */
    public function __construct($id)
    {
        if (is_numeric($id)) {
            $this->newObject($id);
        }
        else {
            $this->setObject($id);
        }
    }

    /**
     * Helper function to set the object.
     *
     * @param integer $id
     *    The ID of the object you wish to set.
     */
    public function newObject($id)
    {
        $this->object = new stdClass();
        $this->object->id = $id;
    }

    /**
     * Helper function to set the object.
     *
     * @param object $object
     *    The object you wish to set.
     */
    public function setObject($object)
    {
        $this->object = $object;
        $this->loaded = true;
    }
}
