<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Evaluation Sheet</title>
        <?php require('../../php/links.php'); ?>
    </head>
    <body class="me-3">
        <div class="contaniner">
            <div class="row">
                <?php include("../../components/subjectInchargeNavbar.php"); ?>
                <div class="col min-vh-100">
                    <?php
                        if (isset($_GET['PROJECT_ID'])) {
                            $project_id = intval($_GET['PROJECT_ID']);

                            include('../../php/config.php');
                            $stmt = $con->prepare("SELECT PROJECT_TITLE FROM projects WHERE PROJECT_ID = ?");
                            $stmt->bind_param("i", $project_id);
                            $stmt->execute();
                            $stmt->bind_result($title);
                            
                            if ($stmt->fetch()) {
                                echo "<h4>$title </h4>";
                            } else {
                                echo "Project not found";
                            }

                            $stmt->close();
                            $con->close();
                        }
                    ?>
                    <div class="container-fluid px-5 pt-3 pb-4">
                        <div class="row">
                            <div class="col">
                                <table class="table">
                                    <thead>
                                        <tr class="table table-secondary">
                                            <th scope="col">Team Member Name</th>
                                            <th scope="col">Position</th>
                                            <th scope="col">PRN</th>
                                            <th scope="col">Class</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include('../../php/config.php');

                                            $sql = "SELECT * FROM team_members WHERE PROJECT_ID = ?";
                                            $stmt = $con->prepare($sql);

                                            if ($stmt) {
                                                $stmt->bind_param("i", $project_id);
                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $row['name'] . "</td>";
                                                        echo "<td>" . $row['position'] . "</td>";
                                                        echo "<td>" . $row['PRN'] . "</td>";
                                                        echo "<td>" . $row['class'] . "</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='5'>No details found for this project.</td></tr>";
                                                }
                                                $stmt->close();
                                            } else {
                                                echo "Error in preparing the SQL statement.";
                                            }
                                            $con->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Project Description</h5>
                                        <p class="card-text"><?php include('description.php'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Evaluation Round 1-->
                    <div class="container-fluid px-5 border border-secondary rounded">
                        <div class="row py-3">
                            <div class="col">
                                <h5>Evaluation Round 1</h5>
                            </div>
                            <div class="col text-end">
                                <form method="post" action="insert_data.php?PROJECT_ID=<?php echo $project_id ?>">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr class="table table-secondary">
                                        <th scope="col">Individual Evaluation</th>
                                        <th scope="col">Objective & methodology of work</th>
                                        <th scope="col">Planning & team structure</th>
                                        <th scope="col">Overall regularity & performance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="number" name="individual_evaluation" min="0" max="10" step="0.1" required></td>
                                        <td><input type="number" name="objective_methodology" min="0" max="10" step="0.1" required></td>
                                        <td><input type="number" name="planning_team_structure" min="0" max="10" step="0.1" required></td>
                                        <td><input type="number" name="overall_regularity_performance" min="0" max="10" step="0.1" required></td>
                                        <!-- <td><input type="int" name="individual_evaluation"></td> -->
                                        <!-- <td><input type="int" name="objective_methodology"></td>
                                        <td><input type="int" name="planning_team_structure"></td>
                                        <td><input type="int" name="overall_regularity_performance"></td> -->
                                        <input type="hidden" name="evaluation_round" value=1>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!--Evaluation Round 2-->
                    <div class="container-fluid my-3 px-5 pt-3 border border-secondary rounded">
                        <div class="row py-3">
                            <div class="col">
                                <h5>Evaluation Round 2 </h5>
                            </div>
                            <div class="col text-end">
                                <form method="post" action="insert_data.php?PROJECT_ID=<?php echo $project_id ?>">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr class="table table-secondary">
                                        <th scope="col">SRS/design</th>
                                        <th scope="col">Project implementation 30%</th>
                                        <th scope="col">Demo</th>
                                        <th scope="col">Overall regularity & performance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="int" name="SRS"></td>
                                        <td><input type="int" name="Project_implementation"></td>
                                        <td><input type="int" name="Demo"></td>
                                        <td><input type="int" name="overall_regularity_performance"></td>
                                        <input type="hidden" name="evaluation_round" value=2>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!--Evaluation Round 3-->
                    <div class="container-fluid my-3 px-5 pt-3 border border-secondary rounded">
                        <div class="row py-3">
                            <div class="col">
                                <h5>Evaluation Round 3 </h5>
                            </div>
                            <div class="col text-end">
                                <form method="post" action="insert_data.php?PROJECT_ID=<?php echo $project_id ?>">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr class="table table-secondary">
                                        <th scope="col">Final SRS</th>
                                        <th scope="col">Project implementation 100%</th>
                                        <th scope="col">Demo & presentation</th>
                                        <th scope="col">Overall regularity & performance</th>
                                    </tr>
                                </thead>                    
                                    <tbody>
                                        <tr>
                                            <td><input type="int" name="Final_SRS"></td>
                                            <td><input type="int" name="Project_implementation"></td>
                                            <td><input type="int" name="Demo_presentation"></td>
                                            <td><input type="int" name="overall_regularity_performance"></td>
                                            <input type="hidden" name="evaluation_round" value=3>
                                        </tr> 
                                    </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
                
        <script>
            function redirectToPage() {
                window.location.href = "php/evaluatorDashboard.php?PROJECT_ID=".$project_id;
            }
        </script>

    </body>
</html>