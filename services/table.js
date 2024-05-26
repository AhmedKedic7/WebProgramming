var TableService = {
    fetchAndPopulateTable: function() {
        RestClient.get(
            "tables/get_table",
            function (data) {
              // Call the function to populate the table with the retrieved data
              TableService.populateTable(data);
            },
            function (xhr) {
              // Handle error
              console.error("Error fetching data:", xhr.responseText);
            }
          );
    },
    
    populateTable: function(data) {
        var table = $("#tbl_clubs"); // Get reference to the table element

        // Clear the existing table body
        table.find("tbody").empty();

        // Loop through each team in the JSON data
        data.forEach(function(team, index) {
            // Calculate team position dynamically
            var position = index + 1;
    
            // Create a new row for the team
            var row = $("<tr>");
    
            // Populate each cell in the row with team data
            row.append($("<td>").addClass("bold").text(position));
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
    
    
    
};

$('#editTableForm').submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    RestClient.post(
        'tables/update_table',
        formData,
        function(response) {
          toastr.success('Table entry updated successfully');
          $('#editTableModal').hide();
          TableService.fetchAndPopulateTable();
        },
        function(xhr) {
          console.error('Error updating table entry:', xhr.responseText);
        }
      );
});

$(document).ready(function() {
    // Fetch data from the server and populate the table when the page is loaded
    TableService.fetchAndPopulateTable();
});
