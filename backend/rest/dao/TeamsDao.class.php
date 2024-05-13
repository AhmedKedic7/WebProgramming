<?php
require_once __DIR__ . "/BaseDao.class.php";

class TeamsDao extends BaseDao{
    public function __construct(){
        parent::__construct("clubs");
    }
    public function add_team($team){
        $query = "INSERT into clubs (club_name, coach_name, number_of_players,stadium, established_year) values (:tName, :coach_Name, :numOfPlayers, :stadium , :establishment_year)";
        $stmt = $this->connection->prepare($query);
        $stmt->execute($team);
        $team['club_id'] = $this->connection->lastInsertId();
        return $team;
    }
    public function get_all_teams() {
        $query = "SELECT * FROM clubs;";
        return $this->query($query, []);
    }
}