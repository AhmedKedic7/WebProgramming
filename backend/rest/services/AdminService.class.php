<?php

require_once __DIR__.'/../dao/AdminsDao.class.php';

class AdminService{

    private $admin_dao;

    public function __construct(){
        $this->admin_dao = new AdminsDao();
    }
    
    public function add_admin($admin){
        // Hash the password using bcrypt before adding the admin
        $admin[':adPswd'] = password_hash($admin[':adPswd'], PASSWORD_BCRYPT);
        
        // Add the admin with the hashed password
        return $this->admin_dao->add_admin($admin);
    }
    public function get_all_admins(){
        return $this->admin_dao->get_all_admins();
    }
    public function delete_admin($admin_id) {
        $this->admin_dao->delete_admin($admin_id);
    }
}