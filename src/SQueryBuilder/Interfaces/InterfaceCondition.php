<?php
namespace SQueryBuilder\Interfaces;


interface InterfaceCondition
{

    /**
     * Построить условие
     *
     * @return string
     */
    public function build();

    /**
     * Получить поле
     *
     * @return string
     */
    public function getField();

    /**
     * Получить оператор
     *
     * @return string
     */
    public function getOperator();

    /**
     * Получить значение
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Установить поле
     *
     * @param string $field
     * @return $this
     */
    public function setField($field);

    /**
     * Установить оператор
     *
     * @param string $operator
     * @return $this
     */
    public function setOperator($operator);

    /**
     * Установить значение
     *
     * @param mixed $value
     * @return $this
     */
    public function setValue($value);

}