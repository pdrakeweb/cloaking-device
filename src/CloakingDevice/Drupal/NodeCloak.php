<?php
namespace CloakingDevice\Drupal;

use stdClass;

/**
 * Provides an on-demand group node object injector.
 */
class NodeCloak extends DrupalCloak
{

    /**
     * Helper function to set the object.
     *
     * @param integer $nid
     *    The node ID of the node you wish to set.
     */
    public function newObject($nid)
    {
        $this->object = new stdClass();
        $this->object->nid = $nid;
    }

    /**
     * Helper function to load the node object.
     */
    protected function load()
    {
        $this->setObject(node_load($this->object->nid));
    }
}
