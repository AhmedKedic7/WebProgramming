// Add event listener to all elements with class 'updateForm1'
document.querySelectorAll('.updateForm1').forEach(function(form) {
  form.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    // Get form data
    const formData = new FormData(event.target);

    // Convert form data to JSON
    const jsonData = {};
    formData.forEach((value, key) => {
        jsonData[key] = value;
    });

    // Log JSON data to the console
    console.log(jsonData);

    // Send success message to user
    alert('Update successful!');

    // Reset the form
    event.target.reset();
  });
});

$(document).ready(function() {
    $('#playerForm').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize form data
        var formData = $(this).serialize();

        // Send form data to the PHP script
        RestClient.post(
            "players/add",
            formData,
            function(data) {
              toastr.success("You have successfully added the player.");
              PlayerService.reload_players_table();
              // Reset the form
              e.target.reset(); // Use e.target.reset() to reset the form // Reset the first form in case there are multiple forms with the same class
            },
            function(xhr) {
              toastr.error("Error.");
            }
          );
    });
});

$(document).ready(function() {
    $('#resultForm').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize form data
        var formData = $(this).serialize();

        // Send form data to the PHP script
        RestClient.post(
            "results/add",
            formData,
            function(data) {
              toastr.success("You have successfully added the result.");
              ResultService.populate_results();
              // Reset the form
              e.target.reset(); // Use e.target.reset() to reset the form // Reset the first form in case there are multiple forms with the same class
            },
            function(xhr) {
              toastr.error("Error.");
            }
          );
    });
});

$(document).ready(function() {
    $('#fixtureForm').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize form data
        var formData = $(this).serialize();

        // Send form data to the PHP script
        RestClient.post("fixtures/add", formData) // Updated URL
            .done(function(data) {
                toastr.success("You have successfully added the fixture.");
                FixtureService.populate_fixtures();
                // Reset the form
                e.target.reset(); // Use e.target.reset() to reset the form // Reset the first form in case there are multiple forms with the same class
            })
            .fail(function(xhr) {
                toastr.error("Error.");
            });
    });
});

$(document).ready(function() {
    $('#adminForm').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize form data
        var formData = $(this).serialize();

        // Send form data to the PHP script
        RestClient.post(
            "admins/add",
            formData,
            function(data) {
              toastr.success("You have successfully added the admin.");
              AdminService.reload_admins_table();
              // Reset the form
              e.target.reset(); // Use e.target.reset() to reset the form // Reset the first form in case there are multiple forms with the same class
            },
            function(xhr) {
              toastr.error("Error.");
            }
          );
    });
});

/*document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission

    // Retrieve input values
    var username = document.getElementById("uName").value;
    var password = document.getElementById("adPswd").value;

    const formData = new FormData(event.target);
  
    const jsonData = {};
    formData.forEach((value, key) => {
        jsonData[key] = value;
    });

    // Log JSON data to the console
    console.log(jsonData);

    event.target.reset();
  
    // Fetch user JSON data from a file
    fetch('./json/users.json')
        .then(response => response.json())
        .then(users => {
            // Check if user credentials match
            var matchedUser = users.find(function(user) {
                return user.username === username && user.password === password;
            });

            if (matchedUser) {
                toastr.success('Login successful!', '');
                $("#adminLink").show();
                window.location.href = '#admin';
            } else {
                toastr.error('Incorrect creditentals', '');
            }
        })
        .catch(error => alert('Error fetching user data:', error));
});*/
// Check if user is already logged in

         if (Utils.get_from_localstorage("user") && window.location.hash === "#login") {
            $("#adminLink").show();
            $("#loginNavItem").hide();
            window.location = "#home";
        
      }
         document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission
           
    // Retrieve input values
    var username = document.getElementById("uName").value;
    var password = document.getElementById("adPswd").value;

    

    // Use RestClient.post to submit the form data
    RestClient.post(
        "auth/login",
        {
            uName: username,
            adPswd: password
        },
        function(response) {
            
            if (response.token!=null) {
                toastr.success('Login successful!', '');
                $("#adminLink").show();
                $("#loginNavItem").hide();
                Utils.set_to_localstorage("user",response);
                window.location = "#admin"; // Redirect to the admin page
            } else {
                toastr.error('Invalid password or username', '');
            }
        },
        function(xhr) {
            toastr.error(xhr.responseText);
        }
    );

    // Reset the form
   
    
});



/*$(document).ready(function() {
  $('#register-form').validate({
      rules: {
          adun: {
              required: true
          },
          email: {
              required: true,
              email: true
          },
          adpswd: {
              required: true,
              minlength: 6
          },
          adpswd_confirm: {
              required: true,
              equalTo: "#loginPassword"
          }
      },
      messages: {
          adun: "Please enter a username",
          email: {
              required: "Please enter your email",
              email: "Please enter a valid email address"
          },
          adpswd: {
              required: "Please enter a password",
              minlength: "Your password must be at least 6 characters long"
          },
          adpswd_confirm: {
              required: "Please confirm your password",
              equalTo: "Passwords do not match"
          }
      },
      submitHandler: function(form) {
          // Get form data
          const formData = new FormData(form);

          // Convert form data to JSON
          const jsonData = {};
          formData.forEach((value, key) => {
              jsonData[key] = value;
          });

          // Log JSON data to the console
          console.log(jsonData);

          // Send success message to user
          toastr.success('Registration successful!', '');

          // Reset the form
          form.reset();
      }
  });
  
});*/


