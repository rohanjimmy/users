<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        .signup-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            max-width: 100%;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .signup-container h1 {
            margin-bottom: 20px;
            color: #333;
            font-size: 1.8rem;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 14px;
            font-weight: bold;
        }
        .form-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        .form-input:focus {
            outline: none;
            border-color: #4285f4;
        }
        .form-submit {
            background-color: #4285f4;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .form-submit:hover {
            background-color: #357ae8;
        }
        .form-footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .form-footer a {
            color: #4285f4;
            text-decoration: none;
            transition: color 0.3s;
        }
        .form-footer a:hover {
            color: #357ae8;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h1>Sign Up</h1>
        <form action="connect.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile Number:</label>
                <input type="text" id="mobile" name="mobile" class="form-input" minlength="10"  maxlength="10" title="" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-input" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required="">
                </div>
            <input type="submit" value="Sign Up" class="form-submit">
        </form>
        <div class="form-footer">
            <a href="index.php">&larr; Back to Home</a>
            <span>Already have an account? <a href="login.php">Login here</a></span>
        </div>
    </div>


    <for="password" type="password" id="password" name="password"
    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
    title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
      
      <script src="
      https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
      </script>
      <script>
      
      
      
      $(document).ready(function() {
          // Existing code...
      
          // Password matching check
          $("input[name='name'], input[name='city'], input[name='district'], input[name='post'], input[name='uname'], input[name='state']").on('input', function(e) {
              $(this).val($(this).val().replace(/[^A-Za-z ]/g, ''));
          });
      
          $("input[name='pin'], input[name='mobile']").on('input', function(e) {
              $(this).val($(this).val().replace(/[^0-9]/g, ''));
          });
      
          $("input[name='email']").on('input', function(e) {
              var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
              if (!re.test($(this).val())) {
                  $('#eerror').show();
              } else {
                  $('#eerror').hide();
              }
          });
      
            
          $("input[name='username']").on('input', function(e) {
                $(this).val($(this).val().replace(/[^A-Za-z0-9]/g, ''));
            });
      
      
            $("input[name='password']").on('input', function(e) {
              $(this).val($(this).val().replace(/[^0-9A-Za-z@/. ]/g, ''));
          }); 
      
      
      
          $(document).ready(function() {
          // Function to check password match
          function checkPasswordMatch() {
              var password = $("#password").val();
              var confirmPassword = $("#confirm_password").val();
      
              if (password != confirmPassword) {
                  $("#passwordMatchMessage").html("Passwords do not match").css("color", "red");
              } else {
                  $("#passwordMatchMessage").html("Passwords match").css("color", "green");
              }
          }
      
          // Call the function on input event for both password and confirm password fields
          $("#password, #confirm_password").on("input", function() {
              checkPasswordMatch();
          });
      });
      
          $('#myForm').on('submit', function(e) {
              var invalid = $(this).attr('data-invalid');
              if (invalid === 'true') {
                  e.preventDefault(); // Prevent form submission
                  alert('Passwords do not match. Please correct.'); // Alert message
              }
          });
      });
      
      
          document.getElementById('assignmentForm').onsubmit = function() {
          var staffSelect = document.getElementById('staffSelect');
      
          if (staffSelect.value === '') {
              alert('Please select.');
              return false; // Prevent form submission
          }
      
          return true; // Submit the form
      };
      
      
          // Form submission prevention
          $('#myForm').on('submit', function(e) {
              if ($(this).attr('data-invalid')) {
                  e.preventDefault(); // Prevent form submission if passwords don't match
                  // You can also provide a user message indicating that passwords don't match here
              }
          });
      
      </script>
      
      
      <script>
          $(document).ready(function() {
              $('#id_photo').change(function(e) {
                  console.log("File selected"); // Debugging statement
                  var file = e.target.files[0];
                  var reader = new FileReader();
                  
                  reader.onload = function(e) {
                      $('#image-preview').attr('src', e.target.result);
                  }
                  
                  reader.readAsDataURL(file);
              });
          });
      </script>
      
      <script>
          // Get today's date
          var today = new Date();
          // Calculate yesterday's date
          var yesterday = new Date(today);
          yesterday.setDate(today.getDate() - 1);
      
          // Format yesterday's date as yyyy-mm-dd
          var yyyy = yesterday.getFullYear();
          var mm = String(yesterday.getMonth() + 1).padStart(2, '0'); // January is 0!
          var dd = String(yesterday.getDate()).padStart(2, '0');
          var yesterdayFormatted = yyyy + '-' + mm + '-' + dd;
      
          // Set the maximum date attribute of the date input field to yesterday's date
          document.getElementById("dob").setAttribute("max", yesterdayFormatted);
      </script>
      
      <script type="text/javascript">
          $(document).ready(function () {
              $("#search").on("keyup", function () {
                  var searchTerm = $(this).val().toLowerCase();
                  var found = false; // Flag to check if any results are found
      
                  $(".member-row").each(function () {
                      var text = $(this).text().toLowerCase();
                      var match = text.indexOf(searchTerm) >= 0;
                      $(this).toggle(match); // Toggle based on match
      
                      if (match) {
                          found = true; // Set flag to true if any match is found
                      }
                  });
      
                  if (!found) {
                      $(".New").show();
                      $(".table-container").hide();
                  } else {
                      $(".New").hide();
                      $(".table-container").show();
                  }
              });
          });
      </script>
      
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
      integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
      crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
      integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
      crossorigin="anonymous"></script>
      
      



</body>
</html>
