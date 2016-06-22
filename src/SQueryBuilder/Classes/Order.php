<?php
namespace SQueryBuilder\Classes;


use InvalidArgumentException;
use SQueryBuilder\Interfaces\InterfaceOrder;

class Order implements InterfaceOrder
{

    /** @var <string, string>[] */
    protected $orders = [];

    /**
     * @return string
     */
    public function build()
    {
        $orders = [];
        foreach ($this->orders as $field => $direction) {
            $orders[] = "`{$field}` {$direction}";
        }

        return (!empty($orders) ? 'ORDER BY ' : '') . implode(', ', $orders);
    }

    /**
     * Очистить
     *
     * @return $this
     */
    public function clear()
    {
        $this->orders = [];
    }

    /**
     * Добавить сортировку
     *
     * @param string $field
     * @param string $direction
     * @return $this
     */
    public function order($field, $direction = self::ASC)
    {
        if (!is_string($field)) {
            throw new InvalidArgumentException('Field name must be a string.');
        }

        if (!in_array($direction, [self::ASC, self::DESC])) {
            throw new InvalidArgumentException('Direction must be "ASC" or "DESC".');
        }

        $this->orders[$field] = $direction;
        return $this;
    }

    /**
     * Добавить сортировки
     *
     * @param <string, string>[] $orders
     * @return $this
     */
    public function orders(array $orders)
    {
        foreach ($orders as $field => $direction) {
            $this->order($field, $direction);
        }

        return $this;
    }

}