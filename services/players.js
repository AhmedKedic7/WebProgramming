var PlayerService = {
    reload_players_datatable: function () {
        Utils.get_datatable(
            "tbl_players",
            Constants.API_BASE_URL + "/backend/get_players.php",
            [
                { data: "player_id" },
                { data: "player_name" },
                { data: "player_position" },
                { data: "team_id" },
                { data: "height_cm" },
                { data: "nationality" },
                { data: "action" }
            ]
        );
    },

   

    delete_player: function (player_id) {
        if (confirm("Do you really want to delete this player?")) {
            RestClient.delete(
                "/backend/delete_player.php?id=" + player_id,
                {},
                function (data) {
                    toastr.success("Player deleted successfully");
                    PlayerService.reload_players_datatable();
                });
        }
    },
};