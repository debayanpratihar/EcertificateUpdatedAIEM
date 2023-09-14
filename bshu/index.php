<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css" id="themeStylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="/ecertificate/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/ecertificate/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/ecertificate/favicon-16x16.png">
<link rel="manifest" href="/ecertificate/site.webmanifest">
<link rel="mask-icon" href="/ecertificate/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
    <button id="themeToggle">Toggle Theme</button>
    
    <script>
      const themeToggle = document.getElementById("themeToggle");
      const themeStylesheet = document.getElementById("themeStylesheet");
    
      themeToggle.addEventListener("click", () => {
        if (themeStylesheet.getAttribute("href") === "styles.css") {
          themeStylesheet.setAttribute("href", "styles-dark.css");
        } else {
          themeStylesheet.setAttribute("href", "styles.css");
        }
      });

      function goBack() {
        history.back(); // Navigate back to the previous page
      }
    </script>
</head>
<body>
    <div class="login-container">
        <h2>Login with your departmental username and password</h2>
        <form method="post" action="login.php">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" required><br><br>
            <button type="submit" name="login_user">Login</button>
        </form>
        <button onclick="goBack()">Back</button> <!-- Add a Back button -->
    </div>
</body>
</html>
