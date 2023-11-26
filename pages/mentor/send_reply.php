<!-- send_reply.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include your database configuration file
    require('../../php/config.php');

    // Get the recipient's email and reply content from the form
    $recipientEmail = $_POST['recipient'];
    $replyContent = $_POST['replyContent'];

    // Check if replyContent is not empty
    if (!empty($replyContent)) {
        // Get the user ID of the mentor (replace 4 with the actual mentor's user ID)
        session_start();
        $mentorUserId = $_SESSION['user_id']; // Replace with your actual session management code

        // Fetch the mentor's email for the sender ID
        $queryMentorEmail = "SELECT email FROM users WHERE user_id = ?";
        $stmtMentorEmail = $con->prepare($queryMentorEmail);
        $stmtMentorEmail->bind_param("i", $mentorUserId);

        if ($stmtMentorEmail->execute()) {
            $resultMentorEmail = $stmtMentorEmail->get_result();
            $rowMentorEmail = $resultMentorEmail->fetch_assoc();
            $mentorEmail = $rowMentorEmail['email'];

            // Insert the reply into the mentor_replies table
            $queryInsertReply = "INSERT INTO mentor_replies(sender_id, receiver_id, content) VALUES ((SELECT user_id FROM users WHERE email = ?), (SELECT user_id FROM users WHERE email = ?), ?)";
            $stmtInsertReply = $con->prepare($queryInsertReply);
            $stmtInsertReply->bind_param("sss", $mentorEmail, $recipientEmail, $replyContent);

            try {
                $stmtInsertReply->execute();
                echo '<p>Reply sent successfully!</p>';
            } catch (mysqli_sql_exception $e) {
                echo '<p>Error sending the reply. ' . $e->getMessage() . '</p>';
            }

            $stmtInsertReply->close();
        } else {
            echo '<p>Error fetching mentor email.</p>';
        }

        $stmtMentorEmail->close();
    } else {
        echo '<p>Error: Reply content cannot be empty.</p>';
    }

    $con->close();
} else {
    echo '<p>Error: Invalid request method.</p>';
}
?>