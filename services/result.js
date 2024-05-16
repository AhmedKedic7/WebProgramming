var ResultService = {
    populate_results: function () {
        $.ajax({
            url: Constants.API_BASE_URL + "results/all",
            type: "GET",
            dataType: "json",
            success: function (data) {
                // Clear the existing results
                $(".allResults").empty();
        
                // Iterate over the results and populate the HTML
                $.each(data, function (index, result) {
                    var resultHtml = `
                        <div class="singleResult">
                            <div class="teams flex">
                                <div class="teamName_teamLogo flex">
                                    <div class="name">${result.home_team}</div>
                                    <div class="teamLogoDiv">
                                        <img src="${result.home_team_logo}" alt="Team Logo" class="teamLogo" />
                                    </div>
                                </div>
                                <p class="time">${result.home_team_score} - ${result.away_team_score}</p>
                                <div class="teamName_teamLogo flex">
                                    <div class="teamLogoDiv">
                                        <img src="${result.away_team_logo}" alt="Team Logo" class="teamLogo" />
                                    </div>
                                    <div class="name">${result.away_team}</div>
                                </div>
                            </div>
                            <span class="venue"><strong>Venue: </strong>${result.home_team_stadium}</span>
                            <div class="editResult flex">
                                <button  class="btn flex deleteBtn" data-id="${result.result_id}">Delete Results <i class="uil uil-trash-alt icon"></i></button>
                            </div>
                        </div>
                    `;
                    $(".allResults").append(resultHtml);
                });
            },
            error: function (xhr, status, error) {
                // Handle error
                console.error("Error fetching results:", error);
            }
        });
        
    },

    delete_result: function (result_id) {
        if (confirm("Do you really want to delete this result?")) {
            RestClient.delete(
                "results/delete/" + result_id,
                {},
                function (data) {
                    toastr.success("Result deleted successfully");
                    ResultService.populate_results(); // Reload or update results after deletion
                },
                function (xhr, status, error) {
                    console.error("Error deleting result:", error);
                    toastr.error("Failed to delete result");
                }
            );
        }
    }
    
    
};

$(document).ready(function () {
    // Call the populate_results function when the document is ready
    ResultService.populate_results();

    // Event delegation for "Manage Results" button click
    $(document).on("click", ".deleteBtn", function () {
        var result_id = $(this).data("id");
        ResultService.delete_result(result_id);
    });

    
});
