<?php

require_once __DIR__ . "/BaseDao.class.php";

class ResultsDao extends BaseDao{
    public function __construct(){
        parent::__construct("results");
    }
    public function add_result($result){
        $query = "INSERT INTO results (home_team, home_team_logo, home_team_stadium, away_team_logo, away_team, home_team_score, away_team_score)
                  SELECT 
                      h.club_name AS home_team,
                      h.club_logo_url AS home_team_logo,
                      h.stadium AS home_team_stadium,
                      a.club_logo_url AS away_team_logo,
                      a.club_name AS away_team,
                      :home_team_score AS home_team_score,
                      :away_team_score AS away_team_score
                  FROM
                      clubs AS h
                      INNER JOIN clubs AS a ON h.club_id = :home_team_id AND a.club_id = :away_team_id";
                  
        $stmt = $this->connection->prepare($query);
        $stmt->execute($result);
        $result['result_id'] = $this->connection->lastInsertId();
        return $result;
    }
    public function get_all_results() {
        $query = "SELECT * FROM results;";
        return $this->query($query, []);
    }
    public function delete_result($id) {
        $query = "DELETE FROM results WHERE result_id = :id";
        $this->execute($query, ["id" => $id]);
    }
}