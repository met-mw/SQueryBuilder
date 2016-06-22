<?php
namespace SQueryBuilder\Classes;


use InvalidArgumentException;
use SQueryBuilder\Interfaces\InterfaceCondition;
use SQueryBuilder\Interfaces\InterfaceQuery;

class Condition implements InterfaceCondition
{

    /** @var string */
    public $field;
    /** @var string */
    public $operator;
    /** @var mixed */
    public $value;

    public function __construct($field, $operator, $value)
    {
        $this->setField($field);
        $this->setOperator($operator);
        $this->setValue($value);
    }

    /**
     * Построить условие
     *
     * @return string
     */
    public function build()
    {
        $condition = "`{$this->getField()}` {$this->getOperator()} ";
        $value = $this->getValue();
        if (is_callable($value)) {
            $value = $value();
        }

        if ($value instanceof InterfaceQuery) {
            $value = "({$value->build()})";
        } elseif (is_string($value)) {
            $value = $value == '?' ? $value : "'{$value}'";
        } elseif (is_null($value)) {
            $value = 'null';
        }

        return $condition . $value;
    }

    /**
     * Получить поле
     *
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Получить оператор
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Получить значение
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Установить поле
     *
     * @param string $field
     * @return $this
     */
    public function setField($field)
    {
        if (!is_string($field)) {
            throw new InvalidArgumentException('Field must be a string.');
        }

        $this->field = $field;
    }

    /**
     * Установить оператор
     *
     * @param string $operator
     * @return $this
     */
    public function setOperator($operator)
    {
        if (!is_string($operator)) {
            throw new InvalidArgumentException('Operator must be a string.');
        }

        $this->operator = $operator;
    }

    /**
     * Установить значение
     *
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}