<!DOCTYPE html>
<html>
  <head>
    <title>Certificate Generator CSE</title>
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
    </script>
  </head>

  <body>
    <div class="welcome-container">
        <?php
        // Start the session
        session_start();

        // Check if the user is logged in
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];

            echo "<h2>Welcome, $username!</h2>";
            echo "<form method='post' action='logout.php'>";
            echo "<button type='submit' name='logout_user'>Logout</button>";
            echo "</form>";
        } else {
            // If the user is not logged in, redirect to the login page
            header('location: index.php');
        }
        ?>
    </div>



  <body>
    <div class="container">
      <h1>Certificate Generator CSE</h1>
      <form action="generate-certificate.php" method="POST" onsubmit="generateCertificate(event)">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <label for="eventName">Event Name:</label>
        <input type="text" id="eventName" name="eventName">
        <label for="eventDate">Event Date:</label>
        <input type="date" id="eventDate" name="eventDate">
        <label for="signature" id="signature-label" class="animating">Upload Signature</label>
        <input type="file" id="signature" name="signature" accept=".png">
        <img id="uploadedSignature" src="" alt="Uploaded Signature" style="display: none; max-width: 200px;">
        <input type="submit" value="Generate Certificate">
      </form>
    </div>
    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
  </body>
</html>
