<?php

require_once __DIR__.'/../dao/FixtureDao.class.php';

class FixtureService{

    private $fixture_dao;

    public function __construct(){
        $this->fixture_dao = new FixtureDao();
    }
    
    public function add_fixture($fixture){
        
        return $this->fixture_dao->add_fixture($fixture);
    }
    public function get_all_fixtures(){
        return $this->fixture_dao->get_all_fixtures();
    }
    public function delete_fixture($fixture_id) {
        return $this->fixture_dao->delete_fixture($fixture_id);
    }
}