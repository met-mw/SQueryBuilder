<?php
namespace SQueryBuilder\Interfaces;


interface InterfaceQuery
{

    /**
     * @param string $table
     * @return $this
     */
    public function table($table);

    /**
     * @return string
     */
    public function build();

}