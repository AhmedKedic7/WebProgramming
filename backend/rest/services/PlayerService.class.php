<?php

require_once __DIR__.'/../dao/PlayersDao.class.php';

class PlayerService{

    private $player_dao;

    public function __construct(){
        $this->player_dao = new PlayersDao();
    }
    
    public function add_player($player){
        
        return $this->player_dao->add_player($player);
    }
    public function get_all_players() {
        return $this->player_dao->get_all_players();
    }
    public function delete_player($player_id) {
        $this->player_dao->delete_player($player_id);
    }
    public function get_player_by_id($player_id) {
        return $this->player_dao->get_player_by_id($player_id);
    }
    public function update_player($player) {
        return $this->player_dao->update_player($player);
    }
}