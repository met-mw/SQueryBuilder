<?php
namespace SQueryBuilder\Interfaces;


interface InterfaceQueryBuilder
{

    /**
     * @return InterfaceDelete
     */
    public function delete();

    /**
     * @return InterfaceInsert
     */
    public function insert();

    /**
     * @return InterfaceSelect
     */
    public function select();

    /**
     * @return InterfaceUpdate
     */
    public function update();


}