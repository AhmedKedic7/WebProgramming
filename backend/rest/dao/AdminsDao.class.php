<?php
require_once __DIR__ . "/BaseDao.class.php";

class AdminsDao extends BaseDao{
    public function __construct(){
        parent::__construct("admins");
    }
    public function add_admin($admin){
        $query = "INSERT into admins (name,surname,team, username, email, role, status, password) values (:fName,:sName, :adminAccess, :uName, :email, :adminRole, :accStatus, :adPswd)";
        $stmt = $this->connection->prepare($query);
        $stmt->execute($admin);
        $admin['admin_id'] = $this->connection->lastInsertId();
        return $admin;
    }
    public function get_all_admins() {
        $query = "SELECT * FROM admins;";
        return $this->query($query, []);
    }
    public function delete_admin($id) {
        $query = "DELETE FROM admins WHERE admin_id = :id";
        $this->execute($query, ["id" => $id]);
    }
}