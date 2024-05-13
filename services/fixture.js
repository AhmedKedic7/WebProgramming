var FixtureService = {
    populate_fixtures: function () {
        $.ajax({
            url: Constants.API_BASE_URL + "fixtures/all",
            type: "GET",
            dataType: "json",
            success: function (data) {
                $(".allFixtures").empty();

                $.each(data, function (index, fixture) {
                    var fixtureHtml = `
                        <div class="singleFixture">
                            <div class="teams flex">
                                <div class="teamName_teamLogo flex">
                                    <div class="name">${fixture.home_team}</div>
                                    <div class="teamLogoDiv">
                                        <img src="${fixture.home_team_logo_url}" alt="Team Logo" class="teamLogo" />
                                    </div>
                                </div>
                                <p class="time">${fixture.match_time}</p>
                                <div class="teamName_teamLogo flex">
                                    <div class="teamLogoDiv">
                                        <img src="${fixture.away_team_logo_url}" alt="Team Logo" class="teamLogo" />
                                    </div>
                                    <div class="name">${fixture.away_team}</div>
                                </div>
                            </div>
                            <span class="venue"><strong>Venue: </strong>${fixture.stadium}</span>
                            <span class="date"><strong>Date: </strong>${fixture.match_date}</span>
                            <span class="matchweek"><strong>Matchweek: </strong>${fixture.match_week}</span>
                            
                            <div class="editResult flex">
                                <button class="btn flex deleteBtn" data-id="${fixture.fixture_id}">
                                    Delete Fixture<i class="uil uil-trash-alt icon"></i>
                                </button>
                                <em>*Only Super Administrators</em>
                            </div>
                        </div>
                    `;
                    $(".allFixtures").append(fixtureHtml);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error fetching fixtures:", error);
            }
        });
    },
    delete_fixture: function (fixture_id) {
        if (confirm("Do you really want to delete this fixture?")) {
            RestClient.delete(
                "fixtures/delete/" + fixture_id,
                {},
                function (data) {
                    toastr.success("Fixture deleted successfully");
                    FixtureService.populate_fixtures(); // Reload or update fixtures after deletion
                },
                function (xhr, status, error) {
                    console.error("Error deleting fixture:", error);
                    toastr.error("Failed to delete fixture");
                }
            );
        }
    }
};

$(document).ready(function () {
    FixtureService.populate_fixtures();

    $(document).on("click", ".deleteBtn", function () {
        var fixture_id = $(this).data("id");
        FixtureService.delete_fixture(fixture_id);
    });
});
