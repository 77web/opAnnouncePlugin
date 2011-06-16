<?php slot('list'); ?>
<?php if($pager->getNbResults() > 0): ?>
  <?php op_include_pager_navigation($pager, 'announce/list?page=%s'); ?>
  <ul class="articleList">
    <?php foreach($pager->getResults() as $announce): ?>
      <li><?php echo op_format_date($announce->getPublishDate(), 'XDateTimeJa'); ?><?php echo link_to($announce->getTitle(), '@announce_show?id='.$announce->getId()); ?></li>
    <?php endforeach; ?>
  </ul>
  <?php op_include_pager_navigation($pager, 'announce/list?page=%s'); ?>
<?php else: ?>
  <p><?php echo __('No announces.'); ?></p>
<?php endif; ?>
<?php end_slot(); ?>

<?php op_include_box('announceList', get_slot('list'), array('title'=>__('Announcements'), 'class'=>'homeRecentList')); ?>