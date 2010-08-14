<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('listing/find') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
     <?php echo $form->renderGlobalErrors() ?>

          <?php echo $form['search']->renderLabel() ?>

          <?php echo $form['search']->renderError() ?>
          <?php echo $form['search'] ?>

          <?php echo $form['listing_type']->renderLabel() ?>

          <?php echo $form['listing_type']->renderError() ?>
          <?php echo $form['listing_type'] ?>

           <input type="submit" value="Save" />

</form>

