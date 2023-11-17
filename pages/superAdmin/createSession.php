<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php require('links.php'); ?>
    <title>CreateSession</title>
</head>
<body>
    <section>
        <div class="container-fluid">
            <div class="row">
                <?php include("components/superAdminNavbar.php");?>
                <div class="col min-vh-100 m-2">
                    <h3>Create Session</h3>
                    <form class="row g-3" action="add_session.php" method="post">
                        <div class="col-md-4">
                            <label class="form-label">Session Title</label>
                            <input class="form-control" type="text" placeholder="Ex: Mini-Project I, Seminar II" id="title" name="title">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Branch</label>
                            <input class="form-control" type="text" placeholder="Ex: Computer Engineering" id="branch" name="branch">
                        </div>
                        <div class="col-md-4">
                            <label for="sem" class="form-label">Semester</label>
                            <select id="sem" name="sem" class="form-select">
                            <option selected>Choose...</option>
                                <option value="Sem I">I</option>
                                <option value="Sem II">II</option>
                                <option value="Sem III">III</option>
                                <option value="Sem IV">IV</option>
                                <option value="Sem V">V</option>
                                <option value="Sem VI">VI</option>
                                <option value="Sem VII">VII</option>
                                <option value="Sem VIII">VIII</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Section</label>
                            <select id="sec" name="sec" class="form-select" type="text">
                                <option selected>Choose...</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="csv" class="form-label">CSV File</label>
                            <input class="form-control" type="file" id="csv">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Date of Creation</label>
                            <input class="form-control" type="date" id="doc" value="<?php echo date('Y-m-d'); ?>" />
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>