<?php
namespace SQueryBuilder;


interface InsertInterface extends QueryInterface
{

    /**
     * @param string $field
     * @return $this
     */
    public function field($field);

    /**
     * @param string[] $fields
     * @return $this
     */
    public function fields(array $fields);

    /**
     * @param array<string, mixed>[] $valuesSet
     * @return $this
     */
    public function valuesSet(array $valuesSet);

    /**
     * @param array<string, mixed> $values
     * @return $this
     */
    public function values(array $values);

}