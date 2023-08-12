<?php
$messages = $processFile->getAlertMessages();
foreach ($messages as $type => $flashMessage) { ?>
    <div class="alert alert-<?php echo $type?>" role="alert">
        <?php echo $flashMessage ?>
    </div>
<?php } ?>
