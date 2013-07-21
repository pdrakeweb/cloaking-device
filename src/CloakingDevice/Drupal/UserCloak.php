<?php
namespace CloakingDevice\Drupal;

use stdClass;

/**
 * Provides an on-demand group node object injector.
 */
class UserCloak extends DrupalCloak
{

    /**
     * Helper function to set the object.
     *
     * @param integer $uid
     *    The user ID of the user you wish to set.
     */
    public function newObject($uid)
    {
        $this->object = new stdClass();
        $this->object->uid = $uid;
    }

    /**
     * Helper function to load the node object.
     */
    protected function load()
    {
        $this->setObject(user_load($this->object->uid));
    }
}
