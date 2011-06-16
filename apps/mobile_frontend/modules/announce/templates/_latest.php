<?php if(isset($list) && count($list)): ?>
  <?php foreach($list as $announce): ?>
    <?php echo link_to($announce->getTitle(), '@announce_show?id='.$announce->getId()); ?><br />
  <?php endforeach; ?>
<?php endif; ?>