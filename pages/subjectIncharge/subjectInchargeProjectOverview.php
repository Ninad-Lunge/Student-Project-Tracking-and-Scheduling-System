<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperAdminProjectOverview</title>
    <?php require('links.php'); ?>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("components/superAdminNavbar.php"); ?>
            <div class="col py-3 min-vh-100">
            <?php
                if (isset($_GET['session_id'])) {
                    // Use proper validation/sanitization method for user input
                    $session_id = intval($_GET['session_id']);

                    // Use prepared statements to prevent SQL injection
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "sptss";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Use prepared statement to prevent SQL injection
                    $stmt = $conn->prepare("SELECT title FROM session WHERE id = ?");
                    $stmt->bind_param("i", $session_id);
                    $stmt->execute();
                    $stmt->bind_result($title);
                    
                    // Fetch and display the title
                    if ($stmt->fetch()) {
                        echo "<h4>Title: $title </h4>";
                    } else {
                        echo "Session not found";
                    }

                    // Close connections
                    $stmt->close();
                    $conn->close();
                }
                ?>
                <?php include("php/table_page.php");?>
            </div>
        </div>
    </div>
</body>
</html>