<?php
require_once __DIR__ . "/BaseDao.class.php";

class FixtureDao extends BaseDao{
    public function __construct(){
        parent::__construct("fixtures");
    }
    public function add_fixture($fixture){
        $query = "INSERT INTO fixtures (home_team, home_team_logo_url, stadium, away_team_logo_url, away_team, match_week, match_date, match_time)
        SELECT 
            h.club_name AS home_team,
            h.club_logo_url AS home_team_logo_url,
            h.stadium AS stadium,
            a.club_logo_url AS away_team_logo_url,
            a.club_name AS away_team,
            :matchWeek AS match_week,
            :matchDate AS match_date,
            :matchTime AS match_time
        FROM
            clubs AS h
            INNER JOIN clubs AS a ON h.club_id = :home_team_fixture_id AND a.club_id = :away_team_fixture_id";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute($fixture);
        $fixture['fixture_id'] = $this->connection->lastInsertId();
        return $fixture;
    }
    public function get_all_fixtures() {
        $query = "SELECT * FROM fixtures;";
        return $this->query($query, []);
    }
   
    public function delete_fixture($id) {
        $query = "DELETE FROM fixtures WHERE fixture_id = :id";
        $this->execute($query, ["id" => $id]);
    }
}