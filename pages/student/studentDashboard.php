<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Session.css">
    <?php require('../../php/links.php'); ?>
    <title>Student Dashboard</title>
</head>
<body>

    <section>
        <div class="container-fluid">
            <div class="row">
                <?php include("../../components/studentNavbar.php"); ?>
                <div class="col py-3 min-vh-100">
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        <?php include('display_projects.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>