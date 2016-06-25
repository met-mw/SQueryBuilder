<?php
namespace SQueryBuilder;


interface QueryBuilderInterface
{

    /**
     * @return DeleteInterface
     */
    public function delete();

    /**
     * @return InsertInterface
     */
    public function insert();

    /**
     * @return SelectInterface
     */
    public function select();

    /**
     * @return UpdateInterface
     */
    public function update();


}