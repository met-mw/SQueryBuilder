<?php


namespace SQueryBuilder\Interfaces;


interface InterfaceUpdate extends InterfaceSUD
{

    /**
     * @param string $field
     * @param mixed $value
     * @return $this
     */
    public function set($field, $value);

    /**
     * @param <string, mixed>[] $sets
     * @return $this
     */
    public function sets(array $sets);

}