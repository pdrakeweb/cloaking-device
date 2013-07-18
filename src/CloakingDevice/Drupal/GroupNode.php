<?php
namespace CloakingDevice\Drupal;

/**
 * Provides an on-demand group node object injector.
 */
class GroupNode extends NodeCloak
{

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
            switch ($requested_property) {
                case 'og_private':
                    $sql = 'SELECT og_private FROM {og} WHERE nid = %d';
                    $properties = db_fetch_array(db_query($sql, $this->object->nid));
                    foreach ($properties as $property => $value) {
                        $this->object->$property = $value;
                    }
                    break;
                default:
                    $this->load();
                    break;
            }
        }

        if (isset($this->object->$requested_property)) {
            return $this->object->$requested_property;
        } else {
            return $this->_null_value;
        }
    }
}
