<?php slot('title', __('Announcements')); ?>

<?php slot('submenu', get_partial('announce/menu')); ?>

<?php if($pager->getNbResults()>0): ?>
  <?php op_include_pager_navigation($pager, 'announce/list?page=%s'); ?>
  <table>
    <thead>
      <tr>
        <th><?php echo __('Title', array(), 'form_announce'); ?></th>
        <th><?php echo __('Target applications'); ?></th>
        
        <th><?php echo __('Is public', array(), 'form_announce'); ?></th>
        <th><?php echo __('Publish date', array(), 'form_announce'); ?></th>
        <th><?php echo __('Updated at'); ?></th>
        <th><?php echo __('Operation'); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($pager->getResults() as $obj): ?>
        <tr>
          <td><?php echo $obj->getTitle(); ?></td>
          <td><?php echo implode(',', $obj->getApps()->getRawValue()); ?></td>
          <td><?php echo __($obj->getIsPublic() ? 'Published' : 'Draft'); ?></td>
          <td><?php echo op_format_date($obj->getPublishDate(), 'XDateTimeJa'); ?></td>
          <td><?php echo op_format_date($obj->getUpdatedAt(), 'XDateTimeJa'); ?></td>
          <td>
            <?php echo button_to(__('Edit'), '@announce_edit?id='.$obj->getId()); ?>
            <?php echo button_to(__('Delete'), '@announce_delete?id='.$obj->getId()); ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php op_include_pager_navigation($pager, 'announce/list?page=%s'); ?>
<?php else: ?>
  <p><?php echo __('No data.'); ?></p>
<?php endif; ?>