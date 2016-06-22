<?php
namespace SQueryBuilder\Interfaces;


interface InterfaceSelect extends InterfaceSUD
{

    /**
     * @param int $limit
     * @return $this
     */
    public function limit($limit);

    /**
     * @param string $field
     * @param string|null $alias
     * @return $this
     */
    public function field($field, $alias = null);

    /**
     * @param <string, string>[] $fields
     * @return $this
     */
    public function fields(array $fields);

    /**
     * @param int $offset
     * @return $this
     */
    public function offset($offset);

    /**
     * @param string $field
     * @param string $direction
     * @return $this
     */
    public function order($field, $direction = 'asc');

    /**
     * @param <string, string>[] $orders
     * @return $this
     */
    public function orders(array $orders);

    /**
     * @return $this
     */
    public function sqlCalcFoundRows();

    /**
     * @param string[] $tables
     * @return $this
     */
    public function tables(array $tables);

}