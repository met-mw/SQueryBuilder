<?php
namespace SQueryBuilder\Classes;


use SQueryBuilder\Interfaces\InterfaceSUD;
use SQueryBuilder\Interfaces\InterfaceWhere;

abstract class SUD implements InterfaceSUD
{

    /** @var InterfaceWhere */
    protected $where;

    public function __construct()
    {
        $this->where = new Where();
    }

    public function where($field, $operator, $value)
    {
        $this->where->addCondition(new Condition($field, $operator, $value));
        return $this;
    }

    /**
     * Добавить условие в виде выражения или скалярного значения
     *
     * @param string|bool|null $expression
     * @return $this
     */
    public function whereExpression($expression)
    {
        $this->where->addExpression($expression);
        return $this;
    }

    public function whereAnd()
    {
        $this->where->_and();
        return $this;
    }

    public function whereOr()
    {
        $this->where->_or();
        return $this;
    }

    public function whereBracketOpen()
    {
        $this->where->openBracket();
        return $this;
    }

    public function whereBracketClose()
    {
        $this->where->closeBracket();
        return $this;
    }

    public function clearWhere()
    {
        $this->where->clear();
        return $this;
    }

}