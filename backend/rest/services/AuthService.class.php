<?php

require_once __DIR__.'/../dao/AuthDao.class.php';

class AuthService{

    private $auth_dao;

    public function __construct(){
        $this->auth_dao = new AuthDao();
    }
    public function get_admin_by_username($username){
        return $this->auth_dao->get_admin_by_username($username);
    }
    
}