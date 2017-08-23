<div style="text-align: center; margin-top: 4em">
    <?php foreach ($workTime as $key=>$time): ?>
<p>
    <?php echo "Step - $key: "; 
          $time;
          include 'common/execution_time.phtml' ?>
</p>        
<?php endforeach; ?>
    
</div>