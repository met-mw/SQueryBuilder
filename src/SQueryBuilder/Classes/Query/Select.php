<?php
namespace SQueryBuilder\Classes\Query;


use InvalidArgumentException;
use SQueryBuilder\Classes\Order;
use SQueryBuilder\Classes\SUD;
use SQueryBuilder\Interfaces\InterfaceOrder;
use SQueryBuilder\Interfaces\InterfaceSelect;

class Select extends SUD implements InterfaceSelect {

    protected $sqlCalcFoundRows = false;

    /** @var string[] */
    protected $tables = [];
    /** @var <string, string>[] */
    protected $fields = [];
    /** @var InterfaceOrder */
    protected $order = null;
    /** @var int */
    protected $limit = null;
    /** @var int */
    protected $offset = null;

    public function __construct()
    {
        parent::__construct();
        $this->order = new Order();
    }

    /**
     * @return string
     */
    public function build()
    {
        $tables = '`' . implode('`, `', $this->tables) . '`';
        $fieldsArray = [];
        foreach ($this->fields as $field => $alias) {
            $fieldsArray[] = "{$field}" . (!is_null($alias) ? " AS {$alias}" : '');
        }
        $fields = implode(', ', $fieldsArray);
        $where = $this->where->build();
        $order = $this->order->build();

        $query = 'SELECT'
            . ($this->sqlCalcFoundRows ? ' SQL_CALC_FOUND_ROWS' : '')
            . ' ' . (empty($fields) ? '*' : $fields)
            . ' FROM'
            . " $tables"
            . (!empty($where) ? " {$where}" : '')
            . (!empty($order) ? " {$order}" : '')
            . (!is_null($this->limit) ? " LIMIT {$this->limit}" : '')
            . (!is_null($this->offset) ? " OFFSET {$this->offset}" : '');

        return $query;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function limit($limit)
    {
        if (!is_integer($limit)) {
            throw new InvalidArgumentException('Limit mast be an integer.');
        }

        $this->limit = $limit;
        return $this;
    }

    /**
     * @param string $field
     * @param string|null $alias
     * @return $this
     */
    public function field($field, $alias = null)
    {
        if (!is_string($field)) {
            throw new InvalidArgumentException('Field name must be a string.');
        }

        if (!is_null($alias) && !is_string($alias)) {
            throw new InvalidArgumentException('Field alias must be a string.');
        }

        $this->fields[$field] = $alias;
        return $this;
    }

    /**
     * @param <string, string>[] $fields
     * @return $this
     */
    public function fields(array $fields)
    {
        foreach ($fields as $alias => $alias) {
            $this->order($alias, $alias);
        }

        $this->fields = $fields;
        return $this;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function offset($offset)
    {
        if (!is_integer($offset)) {
            throw new InvalidArgumentException('Offset must be an integer.');
        }

        $this->offset = $offset;
        return $this;
    }

    /**
     * @param string $field
     * @param string $direction
     * @return $this
     */
    public function order($field, $direction = InterfaceOrder::ASC)
    {
        $this->order->order($field, $direction);
        return $this;
    }

    /**
     * @param <string, string>[] $orders
     * @return $this
     */
    public function orders(array $orders)
    {
        $this->order->orders($orders);
        return $this;
    }

    /**
     * @return $this
     */
    public function sqlCalcFoundRows()
    {
        $this->sqlCalcFoundRows = true;
        return $this;
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

        foreach ($tables as $table) {
            $this->table($table);
        }

        return $this;
    }

}