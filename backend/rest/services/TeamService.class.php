<?php

require_once __DIR__.'/../dao/TeamsDao.class.php';

class TeamService{

    private $team_dao;

    public function __construct(){
        $this->team_dao = new TeamsDao();
    }
    
    public function add_team($team){
        return $this->team_dao->add_team($team);
    }
    public function get_all_teams() {
        return $this->user_dao->get_all_users();
    }
}
