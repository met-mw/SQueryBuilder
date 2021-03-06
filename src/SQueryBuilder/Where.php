<?php
namespace SQueryBuilder;


use InvalidArgumentException;

class Where implements WhereInterface
{

    protected $conditions = [];

    /**
     * Добавить логическое "и"
     *
     * @return $this
     */
    public function _and()
    {
        $this->conditions[] = 'AND';
        return $this;
    }

    /**
     * Добавить логическое "или"
     *
     * @return $this
     */
    public function _or()
    {
        $this->conditions[] = 'OR';
        return $this;
    }

    /**
     * Добавить условие
     *
     * @param ConditionInterface $condition
     * @return $this
     */
    public function addCondition(ConditionInterface $condition)
    {
        $this->conditions[] = $condition;
        return $this;
    }

    /**
     * @param string|bool|null $expression
     * @return $this
     */
    public function addExpression($expression)
    {
        if (!is_string($expression) && !is_bool($expression) && !is_null($expression)) {
            throw new InvalidArgumentException('Expression must be a string, boolean or null.');
        }

        $this->conditions[] = $expression;
        return $this;
    }

    /**
     * Построить блок условий
     *
     * @return string
     */
    public function build()
    {
        $conditions = [];
        foreach ($this->conditions as $condition) {
            $preparedCondition = $condition;
            if (is_callable($condition)) {
                $preparedCondition = $condition();
            }

            if ($preparedCondition instanceof ConditionInterface) {
                $preparedCondition = $preparedCondition->build();
            } elseif (is_null($preparedCondition)) {
                $preparedCondition = 'null';
            } elseif (is_bool($preparedCondition)) {
                $preparedCondition = $preparedCondition ? 'true' : 'false';
            }

            $conditions[] = $preparedCondition;
        }

        $where = '';
        if (!empty($conditions)) {
            $where .= 'WHERE ' . implode(' ', $conditions);
        }

        return $where;
    }

    /**
     * Очистить блок условий
     *
     * @return $this
     */
    public function clear()
    {
        $this->conditions = [];
        return $this;
    }

    /**
     * @return $this
     */
    public function closeBracket()
    {
        $this->conditions[] = ')';
        return $this;
    }

    /**
     * @return $this
     */
    public function openBracket()
    {
        $this->conditions[] = '(';
        return $this;
    }

    /**
     * @return bool
     */
    public function needAnd()
    {
        return !empty($this->conditions)
            && !in_array($this->conditions[sizeof($this->conditions)-1], ['AND', 'OR', '(']);
    }

}