<?php
namespace CloakingDevice\Drupal;

/**
 * Provides an on-demand user node object injector.
 */
class GroupUser extends UserCloak implements \Serializable
{

    /**
     * Override the serialize method for this object.
     *
     * @return string
     *     The serialized string.
     */
    public function serialize() {
        unset($this->object->og_groups);
        return serialize($this->object);
    }

    /**
     * Override the unserialize method for this object.
     *
     * @param mixed $data
     *    The data to unserialize.
     */
    public function unserialize($data) {
        $this->object = unserialize($data);
    }

    /**
     * Override the getData method for this object.
     * @return type
     */
    public function getData() {
        return $this->object;
    }

    /**
     * Implementation of the magic __get method.
     *
     * @param string $requested_property
     * @return mixed
     */
    public function &__get($requested_property)
    {
        if (!isset($this->object->$requested_property)) {
            switch ($requested_property) {
                case 'og_groups':
                    $this->object->og_groups = og_get_subscriptions($this->object->uid);
                    break;

                default:
                    if (!$this->loaded) {
                        $this->load();
                    }
                    break;
            }
        }

        // Return the property.
        if (isset($this->object->$requested_property)) {
            return $this->object->$requested_property;
        } else {
            return $this->_null_value;
        }
    }
}
