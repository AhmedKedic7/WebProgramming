<?php

require_once __DIR__ . "/BaseDao.class.php";

class PlayersDao extends BaseDao{
    public function __construct(){
        parent::__construct("players");
    }
    public function add_player($player){
        $query = "INSERT into players (player_name, team_id, nationality, height_cm, player_position) values (:pFName, :playerTeam, :nationality, :height, :playerPosition )";
        $stmt = $this->connection->prepare($query);
        $stmt->execute($player);
        $player['player_id'] = $this->connection->lastInsertId();
        return $player;
    }
}