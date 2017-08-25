<div style="text-align:center; margin-top:2em;">
<?php if (isset($timeGenerateFile)) { ?>
    <p>Generate File: <strong><?= $timeGenerateFile ?></strong> sec.</p>
<?php } ?>

<?php if (isset($timeCopyRecords)) { ?>
    <p>Copy Record to DB: <strong><?= $timeCopyRecords ?></strong> sec.<p>
<?php } ?>

<?php if (isset($mainTime)) { ?>
    <h1>Main time of work app: <?= $mainTime ?> </h1>
<?php } ?>
</div>