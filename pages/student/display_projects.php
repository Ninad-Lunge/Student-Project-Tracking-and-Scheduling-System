<?php
include('../../php/config.php');

// TEMP DATA....
$student_prn = 2146491245118;

$sql = "SELECT students.*, projects.*, session.title AS session_title
        FROM students
        LEFT JOIN student_projects ON students.prn = student_projects.student_prn
        LEFT JOIN projects ON student_projects.project_id = projects.PROJECT_ID
        LEFT JOIN session ON projects.SESSION_ID = session.id
        WHERE students.prn = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("s", $student_prn);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    echo "Error: " . $stmt->error;
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

$stmt->close();
$con->close();
?>