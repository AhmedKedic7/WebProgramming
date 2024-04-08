$(document).ready(function() {
    // Fetch JSON data when the page is loaded
    $.getJSON("./json/table.json", function(data) {
        // Function to populate the table with JSON data
        populateTable(data);
    });
});

function populateTable(data) {
    var table = $("table"); // Get reference to the table element

    // Loop through each team in the JSON data
    data.teams.forEach(function(team) {
        // Create a new row for the team
        var row = $("<tr>");

        // Populate each cell in the row with team data
        row.append($("<td>").addClass("bold").text(team.pos));
        row.append($("<td>").addClass("flex").append(
            $("<div>").addClass("teamLogoDiv").append(
                $("<img>").attr("src", team.logo).attr("alt", "Team Logo").addClass("teamLogo")
            ),
            $("<div>").addClass("name").text(team.club)
        ));
        row.append($("<td>").text(team.PL));
        row.append($("<td>").text(team.W));
        row.append($("<td>").text(team.L));
        row.append($("<td>").text(team.GF));
        row.append($("<td>").text(team.GA));
        row.append($("<td>").text(team.GD));
        row.append($("<td>").text(team.Pts));

        // Append the row to the table
        table.append(row);
    });
}