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
}