<?php
namespace SQueryBuilder\Classes;


use SQueryBuilder\Classes\Query\Delete;
use SQueryBuilder\Classes\Query\Insert;
use SQueryBuilder\Classes\Query\Select;
use SQueryBuilder\Classes\Query\Update;
use SQueryBuilder\Interfaces\InterfaceDelete;
use SQueryBuilder\Interfaces\InterfaceInsert;
use SQueryBuilder\Interfaces\InterfaceQueryBuilder;
use SQueryBuilder\Interfaces\InterfaceSelect;
use SQueryBuilder\Interfaces\InterfaceUpdate;

class QueryBuilder implements InterfaceQueryBuilder
{

    /**
     * @return InterfaceDelete
     */
    public function delete()
    {
        return new Delete();
    }

    /**
     * @return InterfaceInsert
     */
    public function insert()
    {
        return new Insert();
    }

    /**
     * @return InterfaceSelect
     */
    public function select()
    {
        return new Select();
    }

    /**
     * @return InterfaceUpdate
     */
    public function update()
    {
        return new Update();
    }

}