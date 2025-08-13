<!DOCTYPE html>
<html>
<head>
    <title>Login Test</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Test Login Form</h2>
<form id="loginForm">
    <label>Type:</label><br>
    <select name="type" id="type" required>
        <option value="employee">Employee</option>
        <option value="student">Student</option>
    </select><br><br>

    <label>Email or Contact No:</label><br>
    <input type="text" name="email" id="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" id="password" required><br><br>

    <button type="submit">Login</button>
</form>

<div id="response" style="margin-top:20px; color:blue;"></div>

<script>
$(document).ready(function() {
    $("#loginForm").on("submit", function(e) {
        e.preventDefault(); // Prevent normal form submission

        $.ajax({
            url: "api/login",
            type: "POST",
            data: {
                email: $("#email").val(),
                password: $("#password").val(),
                type: $("#type").val(),
            },
            dataType: "json",
            success: function(response) {
                $("#response").text(JSON.stringify(response));
            },
            error: function(xhr, status, error) {
                $("#response").text("Error: " + xhr.responseText);
            }
        });
    });
});
</script>

</body>
</html>
