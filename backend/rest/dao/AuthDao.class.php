<?php
require_once __DIR__ . "/BaseDao.class.php";

class AuthDao extends BaseDao {
    public function __construct() {
        parent::__construct("admins");
    }

    public function get_admin_by_username($username) {
        $query = "SELECT * FROM admins WHERE username = :uName";
        $admin = $this->query_unique($query, ['uName' => $username]);

        return $admin;
    }
}