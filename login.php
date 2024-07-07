<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            max-width: 100%;
            text-align: center;
        }
        .login-header {
            background-color: #4285f4;
            color: #fff;
            padding: 15px 0;
            margin-bottom: 20px;
        }
        .login-header h1 {
            font-size: 1.5rem;
            margin: 0;
        }
        .login-form {
            padding: 20px;
        }
        .form-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
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
            padding: 10px 20px;
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
            font-size: 12px;
            color: #666;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .back-button {
            background-color: #ccc;
            color: #333;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            font-size: 14px;
            text-align: center;
        }
        .back-button:hover {
            background-color: #999;
            color: #fff;
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
    <div class="login-container">
        <div class="login-header">
            <h1>LOGIN FORM</h1>
        </div>
        <div class="login-form">
            <form name="form" action="log.php" onsubmit="return isValid()" method="POST">
                <input type="email" class="form-input" id="email" name="email" placeholder="Email" required>
                <input type="password" class="form-input" id="password" name="password" placeholder="Password" required>
                <input type="submit" class="form-submit" value="Login" name="submit">
            </form>
            <div class="form-footer">
                <a href="index.php">&larr; Back to Home</a>
                <span>Don't have an account? <a href="signup.php">Sign Up</a></span>
            </div>
        </div>
    </div>

    <script>
        function isValid() {
            var email = document.form.email.value.trim();
            var password = document.form.password.value.trim();

            if (email === "" || password === "") {
                alert("Please enter both email and password.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
