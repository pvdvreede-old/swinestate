<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form);
      $sf_response->addJavascript('tiny_mce/tiny_mce.js');
?>

<?php if (!isset($submitValue)) : $submitValue = 'Save'; endif; ?>
<p>Fields marked with a '*' are required fields.</p>
<form action="<?php echo url_for($module_link.'/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()) : ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="form">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for($back_to); ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', $module_link.'/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="<?php echo $submitValue; ?>" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form; ?>
    </tbody>
  </table>
</form>