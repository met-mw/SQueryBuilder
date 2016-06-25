<?php
namespace SQueryBuilder\Query;


use SQueryBuilder\InsertInterface;

class Insert implements InsertInterface
{

    protected $table;
    protected $fields = [];
    protected $valuesSets = [];

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function fields(array $fields)
    {
        $this->fields = $fields;
        return $this;
    }

    public function field($field)
    {
        $this->fields[] = $field;
        return $this;
    }

    public function valuesSet(array $valuesSet)
    {
        $this->valuesSets = $valuesSet;
        return $this;
    }

    public function values(array $values)
    {
        $this->valuesSets[] = $values;
        return $this;
    }

    public function build()
    {
        $fields = '`' . implode('`, `', $this->fields) . '`';
        $valuesSets = [];
        foreach ($this->valuesSets as $valuesSet) {
            $values = [];
            foreach ($valuesSet as $value) {
                $preparedValue = $value;
                if (is_callable($value)) {
                    $preparedValue = $value();
                } elseif (is_string($value)) {
                    $preparedValue = "'{$value}'";
                } elseif (is_null($value)) {
                    $preparedValue = 'null';
                }

                $values[] = $preparedValue;
            }

            $valuesSets[] = implode(', ', $values);
        }
        $allValues = '(' . implode('), (', $valuesSets) . ')';

        $query = 'INSERT INTO'
            . " `{$this->table}` ({$fields})"
            . ' VALUES'
            . " {$allValues}";

        return $query;
    }

}