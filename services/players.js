var PlayerService = {
    reload_players_table: function () {
        // Make an AJAX request to fetch player data from the server
        $.ajax({
            url: Constants.API_BASE_URL+"players/all", //get players
            type: "GET",
            dataType: "json",
            success: function (data) {
                // Clear the existing table body
                $("#tbl_players tbody").empty();
                
                // Iterate over the player data and populate the table rows
                $.each(data, function (index, player) {
                    var row = "<tr>" +
                        "<td>" + player.player_id + "</td>" +
                        "<td>" + player.player_name + "</td>" +
                        "<td>" + player.player_position + "</td>" +
                        
                        "<td>" + player.height_cm + "</td>" +
                        "<td>" + player.nationality + "</td>" +
                        "<td>" +
                            "<button class='btn deleteBtn' data-id='" + player.player_id + "'>Delete</button>" +
                            "<button class='btn editBtn' data-id='" + player.player_id + "'>Edit</button>" +
                        "</td>" +
                        "</tr>";
                    $("#tbl_players tbody").append(row);
                });
            },
            error: function (xhr, status, error) {
                // Handle error
                console.error("Error fetching player data:", error);
            }
        });
    },

    delete_player: function (player_id) {
        if (confirm("Do you really want to delete this player?")) {
            RestClient.delete(
                "players/delete/" + player_id,
                {},
                function (data) {
                    toastr.success("Player deleted successfully");
                    PlayerService.reload_players_table();
                });
        }
    },

    // Function to handle edit action
    edit_player: function (player_id) {
        // Make an AJAX request to fetch player data from the server
        $.ajax({
            url: Constants.API_BASE_URL + "players/get_player/" + player_id, //get player by id
            method: "GET",
            success: function(response) {
                // Populate form fields with player data
                $('#editPlayerId').val(response.player_id);
                $('#editPlayerName').val(response.player_name);
                $('#editPlayerTeam').val(response.team_id);
                $('#editPlayerNationality').val(response.nationality);
                $('#editPlayerHeight').val(response.height_cm);
                $('#editPlayerPosition').val(response.player_position);
                $('#editPlayerJerseyNumber').val(response.jersey_number);
                // Show edit modal
                $('#editModal').show();
            },
            error: function(xhr, status, error) {
                console.error('Error fetching player data:', error);
            }
        });
        $('#editModal .close').click(function() {
            $('#editModal').hide();
        });
        $(window).click(function(event) {
            if (event.target == $('#editModal')[0]) {
                $('#editModal').hide();
            }
        });
    
        // Handle form submission
        $('#editPlayerForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: Constants.API_BASE_URL + 'players/update_player',
                method: 'POST',
                data: formData,
                success: function(response) {
                    toastr.success('Player updated successfully');
                    $('#editModal').hide();
                    PlayerService.reload_players_table();
                },
                error: function(xhr, status, error) {
                    console.error('Error updating player:', error);
                }
            });
        });
    }

};

$(document).ready(function () {
    // Call the reload_players_table function when the document is ready
    PlayerService.reload_players_table();

    // Event delegation for delete button click
    $(document).on("click", ".deleteBtn", function () {
        var player_id = $(this).data("id");
        PlayerService.delete_player(player_id);
    });

    // Event delegation for edit button click
    $(document).on("click", ".editBtn", function () {
        var player_id = $(this).data("id");
        PlayerService.edit_player(player_id);
    });
});