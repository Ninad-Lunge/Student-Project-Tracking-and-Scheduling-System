<?php
    include('../../php/config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = isset($_POST["title"]) ? $_POST["title"] : "";
        $branch = isset($_POST["branch"]) ? $_POST["branch"] : "";
        $semester = isset($_POST["sem"]) ? $_POST["sem"] : "";
        $section = isset($_POST["sec"]) ? $_POST["sec"] : "";
        $date_of_creation = isset($_POST["doc"]) ? $_POST["doc"] : "";

        $pname = isset($_FILES["csv"]["name"]) ? $title . "-" . $_FILES["csv"]["name"] : "";
        $tname = isset($_FILES["file"]["tmp_name"]) ? $_FILES["file"]["tmp_name"] : "";

        $uploads_dir = '../../csv_files';
        move_uploaded_file($tname, $uploads_dir.'/'.$pname);

        $sql = "INSERT INTO session_table1(title, branch, semester, section, date_of_creation, csv) 
                VALUES ('$title','$branch','$semester','$section','$date_of_creation','$pname')";

        if(mysqli_query($con, $sql)) {
            echo "File Successfully uploaded";

            $session_id_query = "SELECT id FROM session WHERE title='$title'";
            $session_id_result = mysqli_query($con, $session_id_query);
            if ($session_id_result) {
                $row = mysqli_fetch_assoc($session_id_result);
                $session_id = isset($row['id']) ? $row['id'] : "";

                $csvFile = "../csv_files/{$pname}";

                if (($handle = fopen($csvFile, "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $proj_title = $data[0];
                        $domain = $data[1];
                        $description = $data[2];
                        $leader = $data[3];
                        $lead_prn = $data[4];
                        $m1_prn = $data[5];
                        $m2_prn = $data[6];
                        $m3_prn = $data[7];

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
            } else {
                echo "Error fetching session_id: " . $con->error;
            }

            echo '<script>
                    var closeButton = document.getElementById("closeForm");
                    if (closeButton) {
                        closeButton.click();
                    }
                    </script>';
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }

    mysqli_close($con);
?>