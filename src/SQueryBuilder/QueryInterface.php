<?php
namespace SQueryBuilder;


interface QueryInterface
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