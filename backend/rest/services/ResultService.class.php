<?php

require_once __DIR__.'/../dao/ResultsDao.class.php';

class ResultService{

    private $result_dao;

    public function __construct(){
        $this->result_dao = new ResultsDao();
    }
    
    public function add_result($result){
        
        return $this->result_dao->add_result($result);
    }
    public function get_all_results(){
        return $this->result_dao->get_all_results();
    }
    public function delete_result($result_id) {
        return $this->result_dao->delete_result($result_id);
    }
}