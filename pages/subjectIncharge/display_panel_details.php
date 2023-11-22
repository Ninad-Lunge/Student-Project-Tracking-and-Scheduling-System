<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('../../php/links.php'); ?>
    <title>Panel Details</title>
</head>
<body>

    <section>
        <div class="container-fluid">
            <div class="row">
                <?php include("../../components/subjectInchargeNavbar.php"); ?>
                <div class="col py-3 min-vh-100">
                    <?php
                        include('../../php/config.php');

                        // if (isset($_GET['panel_id'])) {
                        //     $panel_id = $_GET['panel_id'];

                            $sql = "SELECT * FROM projects WHERE panel_id = 1";
                            $result = $con->query($sql);

                            // Display the data in a table
                            if ($result->num_rows > 0) {
                                echo "<table class='table table-hover'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th scope='col'>Project Title</th>";
                                echo "<th scope='col'>Team Leader</th>";
                                echo "<th scope='col'>Domain</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while ($row = $result->fetch_assoc()) {
                                    $project_id = $row['PROJECT_ID'];
                                    echo "<tr>";
                                    echo "<td><a href='project_evaluation_details.php?PROJECT_ID=$project_id' class='text-decoration-none text-reset'>" . $row['PROJECT_TITLE'] . "</a></td>";
                                    echo "<td><a href='project_evaluation_details.php?PROJECT_ID=$project_id' class='text-decoration-none text-reset'>" . $row['TEAM_LEADER'] . "</a></td>";
                                    echo "<td><a href='project_evaluation_details.php?PROJECT_ID=$project_id' class='text-decoration-none text-reset'>" . $row['DOMAIN'] . "</a></td>";
                                    echo "</tr>";
                                }

                                echo "</tbody>";
                                echo "</table>";
                            } else {
                                echo "No data available for this session.";
                            }
                        // }

                        $con->close();
                    ?>
                </div>
            </div>
        </div>
    </section>

</body>
</html>