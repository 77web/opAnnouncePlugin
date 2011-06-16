<?php slot('title', __(($form->isNew() ? 'Add an announcement' : 'Edit announcement'))); ?>
<?php slot('submenu', get_partial('announce/menu')); ?>

<?php echo $form->renderFormTag('', array('method'=>'post')); ?>

<div class="form">

  <table>
    <?php echo $form; ?>
  </table>

<input type="submit" value="<?php echo $form->isNew() ? __('Add') : __('Edit'); ?>" />
</div>
</form>