<?php 
    $_SESSION['session_id'] = $_GET['session_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('../../php/links.php'); ?>
    <title>Display Panels</title>
</head>
<body>
    
    <section>
        <div class="container-fluid">
            <div class="row">
                <?php include("../../components/subjectInchargeNavbar.php"); ?>
                <div class="col min-vh-100 py-3">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-outline-dark m-1" style='max-width: 8rem;'>
                                <a href="add_panel.php" class='text-decoration-none text-reset'>Add Panel</a>
                            </button>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        <?php
                            include('../../php/config.php');

                            $user_id = $_SESSION['user_id'];
                            $session_id = $_GET['session_id'];
                            $query = "SELECT * from panels WHERE s_id = " . $session_id;
                            $result = $con->query($query);

                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $panel_id = $row['id'];
                                    $_SESSION['panel_id'] = $panel_id;

                                    echo '<div class="col py-3">
                                        <div class="card border-dark mb-3" style="max-width: 18rem;">
                                        <a href="display_panel_details.php?session_id=' . $session_id . '" class="text-decoration-none text-reset">
                                        <div class="card-header"> Panel ID:' . $row['id'] . '</div>
                                        <div class="card-body text-dark">';

                                    include("display_panelists.php");

                                    echo '</div>
                                        </a>
                                        </div>';
                                    echo '</div>';
                                }
                            } else {
                                echo "No cards available.";
                            }
                            $con->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>