<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Session.css">
    <?php require('../../php/links.php'); ?>
    <title>SuperAdminDashboard</title>
</head>
<body>

    <section>
        <div class="container-fluid">
            <div class="row">
                <?php include("../../components/superAdminNavbar.php"); ?>
                <div class="col py-3">
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        <?php include 'display_sessions.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
        include('../../php/config.php');
        
        if (isset($_POST["submit"])){
            $title = $_POST["title"];
            $branch = $_POST['branch'];
            $semester = $_POST['semester'];
            $date_of_creation = $_POST[''];
        
            $pname = $title."-".$_FILES["document"]["name"];

            $tname = $_FILES["document"]["tmp_name"];

            $uploads_dir = '../csv_files';
            move_uploaded_file($tname, $uploads_dir.'/'.$pname);

            $sql = "INSERT INTO session_table1(title,branch,semester,csv) VALUES ('$title','$branch','$semester','$pname')";

            if(mysqli_query($con, $sql)){
                echo "File Successfully uploaded";

                $session_id_query = "SELECT id FROM session_table1 WHERE title='$title'";
                $session_id_result = mysqli_query($conn, $session_id_query);
                if ($session_id_result) {
                    $row = mysqli_fetch_assoc($session_id_result);
                    $session_id = $row['id'];

                    $csvFile = "../../csv_files/{$pname}";

                    // Open and read the CSV file
                    if (($handle = fopen($csvFile, "r")) !== FALSE) {
                        // Loop through the CSV data
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            // Assuming the CSV file has three columns (proj_title, domain, description, leader, lead_prn, m1_prn, m2_prn, m3_prn)
                            $proj_title = $data[0];
                            $domain = $data[1];
                            $description = $data[2];
                            $leader = $data[3];
                            $lead_prn = $data[4];
                            $m1_prn = $data[5];
                            $m2_prn = $data[6];
                            $m3_prn = $data[7];
                            
                            // Insert data into the MySQL table
                            $query = "INSERT INTO projects (PROJECT_TITLE, DOMAIN, DESCRIPTION, TEAM_LEADER, LEADER_PRN, MEMBER_1_PRN, MEMBER_2_PRN, MEMBER_3_PRN, SESSION_ID) 
                            VALUES ('$proj_title', '$domain', '$description', '$leader', '$lead_prn', '$m1_prn', '$m2_prn', '$m3_prn', '$session_id')";
                            
                            if ($con->query($query) === TRUE) {
                                echo "Record inserted successfully.<br>";
                            } else {
                                echo "Error: " . $query . "<br>" . $con->error;
                            }
                        }
                        
                        fclose($handle);
                    }
                }
                else {
                    echo "Error fetching session_id: " . $con->error;
                }

                echo '<script>
                        var closeButton = document.getElementById("closeForm");
                        if (closeButton) {
                            closeButton.click();
                        }
                        </script>';
            }
            else{
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        }

        // Close connection
        mysqli_close($con);
    ?>
</body>
</html>