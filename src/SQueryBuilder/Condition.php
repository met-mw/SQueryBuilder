<?php
namespace SQueryBuilder;


use InvalidArgumentException;

class Condition implements ConditionInterface
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

    protected function prepareValue($inputValue)
    {
        $value = $inputValue;
        if (is_callable($inputValue)) {
            $value = $this->prepareValue($inputValue());
        } elseif ($inputValue instanceof QueryInterface) {
            $value = "({$inputValue->build()})";
        } elseif (is_array($inputValue)) {
            $value = '';
            foreach ($inputValue as $item) {
                $value .= empty($value) ? $this->prepareValue($item) : ',' . $this->prepareValue($item);
            }
            $value = "({$value})";
        } elseif (is_numeric($inputValue)) {
            $value = is_integer($inputValue) ? (int)$inputValue : (double)$inputValue;
        } elseif (is_string($inputValue)) {
            $value = $inputValue == '?' ? $inputValue : "'{$inputValue}'";
        } elseif (is_null($inputValue)) {
            $value = 'null';
        }

        return $value;
    }

    /**
     * Построить условие
     *
     * @return string
     */
    public function build()
    {
        $condition = "`{$this->getField()}` {$this->getOperator()} ";
        return $condition . $this->prepareValue($this->getValue());
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