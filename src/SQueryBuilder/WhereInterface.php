<?php
namespace SQueryBuilder;


interface WhereInterface
{

    /**
     * Добавить логическое "и"
     *
     * @return $this
     */
    public function _and();

    /**
     * Добавить логическое "или"
     *
     * @return $this
     */
    public function _or();

    /**
     * Добавить условие
     *
     * @param ConditionInterface $condition
     * @return $this
     */
    public function addCondition(ConditionInterface $condition);

    /**
     * Построить блок условий
     *
     * @return string
     */
    public function build();

    /**
     * Очистить блок условий
     *
     * @return $this
     */
    public function clear();

    /**
     * @return $this
     */
    public function closeBracket();

    /**
     * @return $this
     */
    public function openBracket();

}