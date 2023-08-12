<?php if(isset($_GET['e']) and $_GET['e']) {
    $email = $processFile->getEmployee($_GET['e'],'email_address');
    ?>
    <div class="row justify-content-md-center">
        <h6>Edit Employee email</h6>
        <form name="edit_employee" action="index.php" method="post">
            <input type="email" name="email" value="<?php echo $email ?>" required>
            <input type="hidden" name="id" value="<?php echo $_GET['e'] ?>">
            <input class="btn btn-success" type="submit" name="save" value="save">
            <a class="btn btn-warning" href="/">Cancel</a>
        </form>
    </div>
<?php }?>

<?php $allRecords = $processFile->getRecordsToDisplay() ?>
<?php if($allRecords){ ?>
    <table class="table table-stripe">
        <?php $headers = $processFile->getColumns() ?>
        <thead>
        <th>Company name</th>
        <th>Average salary</th>
        <th>Name</th>
        <th>Email address</th>
        <th>Salary</th>
        <th></th>
        </thead>
        <tbody>
        <?php foreach ($allRecords as $record) { ?>
            <?php foreach ($record['employees'] as $key=>$employee) { ?>
                <tr>
                    <?php
                    if( $key ==0) { ?>
                        <td rowspan="<?php echo $record['count'] ?>"><?php echo $record['company_name'] ?></td>
                        <td rowspan="<?php echo $record['count'] ?>">$<?php echo $record['average_salary'] ?></td>
                    <?php } ?>
                    <td><?php echo $employee['employee'] ?></td>
                    <td><?php echo $employee['email_address'] ?></td>
                    <td>$<?php echo $employee['salary'] ?></td>
                    <td>
                        <a class="btn btn-warning" href="?e=<?php echo $employee['id']?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>

        <?php } ?>
        </tbody>
    </table>
<?php } ?>