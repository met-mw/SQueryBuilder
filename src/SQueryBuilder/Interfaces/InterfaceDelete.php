<?php
namespace SQueryBuilder\Interfaces;


interface InterfaceDelete extends InterfaceSUD
{

    /**
     * @param string[] $tables
     * @return $this
     */
    public function tables(array $tables);

    /**
     * @param string $usingTable
     * @return $this
     */
    public function usingTable($usingTable);

    /**
     * @param string[] $usingTables
     * @return $this
     */
    public function usingTables(array $usingTables);

}