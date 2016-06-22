<?php
namespace SQueryBuilder\Interfaces;


interface InterfaceSUD extends InterfaceQuery
{

    /**
     * @return $this
     */
    public function clearWhere();

    /**
     * @param string $field
     * @param string $operator
     * @param mixed $value
     * @return $this
     */
    public function where($field, $operator, $value);

    /**
     * Добавить условие в виде выражения или скалярного значения
     *
     * @param string|bool|null $expression
     * @return $this
     */
    public function whereExpression($expression);

    /**
     * @return $this
     */
    public function whereAnd();

    /**
     * @return $this
     */
    public function whereBracketClose();

    /**
     * @return $this
     */
    public function whereBracketOpen();

    /**
     * @return $this
     */
    public function whereOr();

}