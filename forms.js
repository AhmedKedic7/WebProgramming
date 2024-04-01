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

// Add event listener to all elements with class 'createForm'
document.querySelectorAll('.createForm').forEach(function(form) {
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
    alert('Created successfully!');

    // Reset the form
    event.target.reset();
  });
});



document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission

    // Retrieve input values
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

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
});

$(document).ready(function() {
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
  
});
document.getElementById("signOutBtn").addEventListener("click", function(event) {
    // Prevent default link behavior
    event.preventDefault();

    // Hide the admin link
    $("#adminLink").hide();

    // Redirect to home page
    window.location.href = '#home';
});
