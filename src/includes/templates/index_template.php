<?php include_once('header.php')  ?>
<body>
<div class="container mt-5">
    <h3 class="mb-2">Salary Checker</h3>
    <?php
    include_once('alert_message.php') ?>
    <div class="row justify-content-md-center">
        <form class="form-inline" method="post" action="index.php" enctype="multipart/form-data">
            <div class="form-group mb-2">
                <input type="file" class="form-control" name="csv_file" required>
            </div>
            <input class="btn btn-danger" type="submit" value="Upload" name="submit">
        </form>
    </div>
    <?php
    include_once('employee_records.php') ?>
</div>
</body>
</html>