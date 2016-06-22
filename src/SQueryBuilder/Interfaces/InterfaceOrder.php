<?php
namespace SQueryBuilder\Interfaces;


interface InterfaceOrder
{

    const ASC = 'ASC';
    const DESC = 'DESC';

    /**
     * @return string
     */
    public function build();

    /**
     * Очистить
     *
     * @return $this
     */
    public function clear();

    /**
     * Добавить сортировку
     *
     * @param string $field
     * @param string $direction
     * @return $this
     */
    public function order($field, $direction = self::ASC);

    /**
     * Добавить сортировки
     *
     * @param <string, string>[] $orders
     * @return $this
     */
    public function orders(array $orders);

}