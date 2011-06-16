<?php slot('title', __('Delete the announcement')); ?>

<?php slot('submenu', get_partial('announce/menu')); ?>

<p><?php echo __('Are you sure to delete it?'); ?></p>

<table>
  <tr>
    <th><?php echo __('Title', array(), 'form_announce'); ?></th>
    <td><?php echo $announce->getTitle(); ?></td>
  </tr>
  <tr>
    <th><?php echo __('Body', array(), 'form_announce'); ?></th>
    <td><?php echo $announce->getIsHtml() ? $announce->getBody(ESC_RAW) : nl2br($announce->getBody()); ?></td>
  </tr>
</table>

<form action="<?php echo url_for('@announce_delete?id='.$announce->getId()); ?>" method="post">
  <?php echo $form; ?>
  <input type="submit" value="<?php echo __('Delete'); ?>" />
  <?php echo button_to(__('Back'), 'announce/list'); ?>
</form>