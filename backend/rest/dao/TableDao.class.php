<?php
require_once __DIR__ . "/BaseDao.class.php";

class TableDao extends BaseDao{
    public function __construct(){
        parent::__construct("tableclub");
    }
    public function get_table(){
        $query = "SELECT * FROM tableclub ORDER BY Pts DESC, GD DESC;";
        return $this->query($query, []);
    }
    public function update_table($table_data) {
        $query = "UPDATE tableclub 
                  SET PL = :PL, 
                      W = :W, 
                      L = :L, 
                      GF = :GF, 
                      GA = :GA, 
                      GD = :GD, 
                      Pts = :Pts 
                  WHERE id = :table_id";
        $this->execute($query, $table_data);
    }
    

};