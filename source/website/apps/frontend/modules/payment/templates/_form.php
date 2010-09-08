<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" '; ?>>
  <table class="form">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Confirm Payment" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form; ?>
    </tbody>
  </table>
</form>