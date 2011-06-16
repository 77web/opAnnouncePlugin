<?php if(isset($list) && count($list)): ?>
  <ul id="announce">
    <?php foreach($list as $announce): ?>
      <li><?php echo link_to($announce->getTitle(), '@announce_show?id='.$announce->getId()); ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>