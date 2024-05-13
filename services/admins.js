var AdminService = {
    reload_admins_table: function () {
        // Make an AJAX request to fetch admin data from the server
        $.ajax({
            url: Constants.API_BASE_URL + "admins/all",
            type: "GET",
            dataType: "json",
            success: function (data) {
                // Clear the existing table body
                $("#tbl_admins tbody").empty();
                
                // Iterate over the admin data and populate the table rows
                $.each(data, function (index, admin) {
                    var row = "<tr>" +
                        "<td>" + admin.admin_id + "</td>" +
                        "<td>" + admin.name + "</td>" +
                        "<td>" + (admin.surname || "") + "</td>" +
                        "<td>" + (admin.team || "") + "</td>" +
                        "<td>" + (admin.username || "") + "</td>" +
                        "<td>" + (admin.email || "") + "</td>" +
                        "<td>" + (admin.role || "") + "</td>" +
                        "<td>" + (admin.status || "") + "</td>" +
                        "<td>" +
                            "<button class='btn deleteBtn' data-id='" + admin.admin_id + "'>Delete</button>" +
                            
                        "</td>" +
                        "</tr>";
                    $("#tbl_admins tbody").append(row);
                });
            },
            error: function (xhr, status, error) {
                // Handle error
                console.error("Error fetching admin data:", error);
            }
        });
        
    },
    delete_admin: function(admin_id){
        if (confirm("Do you really want to delete this admin?")) {
            RestClient.delete(
                "admins/delete/" + admin_id,
                {},
                function(data) {
                    toastr.success("Admin deleted successfully");
                    AdminService.reload_admins_table(); // Reload or update admins after deletion
                },
                function(xhr, status, error) {
                    console.error("Error deleting admin:", error);
                    toastr.error("Failed to delete admin");
                }
            );
        }
    }
    
};
    $(document).ready(function () {
        // Call the populate_results function when the document is ready
        AdminService.reload_admins_table();
        $(document).on("click", ".deleteBtn", function () {
            var admin_id = $(this).data("id");
            AdminService.delete_admin(admin_id);
        });
    
});
    