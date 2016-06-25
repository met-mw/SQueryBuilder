<?php
namespace SQueryBuilder;


use SQueryBuilder\Query\Delete;
use SQueryBuilder\Query\Insert;
use SQueryBuilder\Query\Select;
use SQueryBuilder\Query\Update;

class QueryBuilder implements QueryBuilderInterface
{

    /**
     * @return Delete
     */
    public function delete()
    {
        return new Delete();
    }

    /**
     * @return Insert
     */
    public function insert()
    {
        return new Insert();
    }

    /**
     * @return Select
     */
    public function select()
    {
        return new Select();
    }

    /**
     * @return Update
     */
    public function update()
    {
        return new Update();
    }

}