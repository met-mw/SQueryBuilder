<?php
namespace SQueryBuilder\Query;

use Exception;
use SQueryBuilder\SUD;
use SQueryBuilder\UpdateInterface;

class Update extends SUD implements UpdateInterface
{

    protected $table;
    protected $sets = [];

    /**
     * @return string
     * @throws Exception
     */
    public function build() {
        $setsItems = [];
        foreach ($this->sets as $field => $value) {
            $preparedValue = $value;
            if (is_callable($value)) {
                $preparedValue = $value();
            } elseif (is_string($value)) {
                $preparedValue = "'{$value}'";
            } elseif (is_null($value)) {
                $preparedValue = 'null';
            }

            $setsItems[] = "`{$field}`={$preparedValue}";
        }
        $sets = implode(', ', $setsItems);

        $where = $this->where->build();
        if (!empty($where)) {
            $where = " {$where}";
        }

        if (empty($sets)) {
            throw new Exception('Update "sets" are required.');
        }

        $query = 'UPDATE'
            . " `{$this->table}`"
            . ' SET'
            . " {$sets}{$where}";

        return $query;
    }

    public function sets(array $sets) {
        $this->sets = $sets;
        return $this;
    }

    public function set($field, $value) {
        $this->sets[$field] = $value;
        return $this;
    }

    /**
     * @param string $table
     * @return $this
     */
    public function table($table) {
        $this->table = $table;
        return $this;
    }

}