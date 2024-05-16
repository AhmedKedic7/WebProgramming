<?php

require_once __DIR__.'/../dao/TableDao.class.php';

class TableService{

    private $table_dao;

    public function __construct(){
        $this->table_dao = new TableDao();
    }
    
    public function get_table() {
        return $this->table_dao->get_table();
    }
    public function update_table($table) {
        return $this->table_dao->update_table($table);
    }
}
