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
                    <?php
                        if(isset($_SESSION['success']) && $_SESSION['success'] == 1) {
                            echo '<div class="alert alert-warning alert-dismissible fade show col-md-4" role="alert">
                                Subject Incharge Added Successfully!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            unset($_SESSION['success']);
                        }
                    ?>
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        <?php include 'display_sessions.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>