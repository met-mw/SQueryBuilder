<?php
namespace SQueryBuilder\Classes\Query;


use InvalidArgumentException;
use SQueryBuilder\Classes\SUD;
use SQueryBuilder\Interfaces\InterfaceDelete;

class Delete extends SUD implements InterfaceDelete
{

    protected $tables = [];
    protected $usingTables = [];

    public function build()
    {
        $tables = '`' . implode('`, `', $this->tables) . '`';
        $usingTables = empty($this->usingTables) ? '' : ' USING ' . implode(', ', $this->usingTables);
        $where = $this->where->build();
        if (!empty($where)) {
            $where = " {$where}";
        }
        $query = 'DELETE FROM'
            . " $tables"
            . " {$usingTables}{$where}";

        return $query;
    }

    /**
     * @param string $table
     * @return $this
     */
    public function table($table)
    {
        if (!is_string($table)) {
            throw new InvalidArgumentException('Table name must be a string.');
        }

        $this->tables[] = $table;
        return $this;
    }

    /**
     * @param string[] $tables
     * @return $this
     */
    public function tables(array $tables)
    {
        array_filter($tables, function($table) {
            if (!is_string($table)) {
                throw new InvalidArgumentException('Table name must be a string.');
            }

            return true;
        });

        $this->tables = $tables;
        return $this;
    }

    /**
     * @param string $usingTable
     * @return $this
     */
    public function usingTable($usingTable)
    {
        if (!is_string($usingTable)) {
            throw new InvalidArgumentException('Table name must be a string.');
        }

        $this->usingTables[] = $usingTable;
        return $this;
    }

    public function usingTables(array $usingTables)
    {
        array_filter($usingTables, function($table) {
            if (!is_string($table)) {
                throw new InvalidArgumentException('Table name must be a string.');
            }

            return true;
        });

        $this->usingTables = $usingTables;
        return $this;
    }

}