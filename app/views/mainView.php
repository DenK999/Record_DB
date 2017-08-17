<?php foreach ($workTime as $key=>$time): ?>
<p>
    <?php echo "Step - $key: "; 
          $time;
          include 'common/execution_time.phtml' ?>
</p>        
<?php endforeach; ?>

