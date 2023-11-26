<?php
    include('../../php/config.php');

    // $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
    // $query = "SELECT * from panelists WHERE user_id = " . $user_id;
    // session_start();
    $user_id = $_SESSION['user_id'];

    // $s = $con->prepare($query);
    // $s->execute();
    // $student_prn_result = $s->get_result();
    // $student_prn_row = $student_prn_result->fetch_assoc();

    // $student_prn = $student_prn_row['prn'];

    $sql = "SELECT * FROM projects WHERE PROJECT_ID = 
            (SELECT project_id FROM project_panelist WHERE panelist_id = (
            SELECT id FROM panelists WHERE user_id = $user_id))";
    $result = $con->query($sql);

    // $stmt = $con->prepare($sql);
    // $stmt->bind_param("s", $student_prn);
    // $stmt->execute();
    // $result = $stmt->get_result();

    if (!$result) {
        echo "Error: " . $con->error;
    } else {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col">
                    <a href="project_details.php?PROJECT_ID=' . $row['PROJECT_ID'] . '" class="text-decoration-none text-reset">
                    <div class="card border-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header">' . $row['PROJECT_TITLE'] . '</div>
                        <div class="card-body text-dark">
                            <h5 class="card-title">' . $row['session_title'] . '</h5>
                        </div>
                    </div>
                </div>';
            }

            $result->free_result();
        } else {
            echo "No records found.";
        }
    }

    // $stmt->close();
    $con->close();
?>