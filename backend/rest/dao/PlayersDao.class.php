<?php

require_once __DIR__ . "/BaseDao.class.php";

class PlayersDao extends BaseDao{
    public function __construct(){
        parent::__construct("players");
    }
    public function add_player($player){
        $query = "INSERT into players (jersey_number, player_name, team_id, nationality, height_cm, player_position) values (:jersey_number, :pFName, :playerTeam, :nationality, :height, :playerPosition )";
        $stmt = $this->connection->prepare($query);
        $stmt->execute($player);
        $player['player_id'] = $this->connection->lastInsertId();
        return $player;
    }
    public function get_all_players() {
        $query = "SELECT * FROM players;";
        return $this->query($query, []);
    }
    
    public function delete_player($id) {
        $query = "DELETE FROM players WHERE player_id = :id";
        $this->execute($query, ["id" => $id]);
    }
    public function get_player_by_id($player_id) {
        return $this->query_unique("SELECT * FROM players WHERE player_id = :id", ["id" => $player_id]);
    }
    public function update_player($player) {
        $query = "UPDATE players SET jersey_number = :jersey_number, player_name = :pFName, team_id = :playerTeam, nationality = :nationality, height_cm = :height, player_position = :playerPosition WHERE player_id = :player_id";
        $this->execute($query, $player);
    }
}