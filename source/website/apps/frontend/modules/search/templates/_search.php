<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div id='search'>
    <form action="<?php echo url_for('search'.'/'.$listing_type) ?>" method="get" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php echo $form->renderGlobalErrors() ?>
    <p><?php echo $form['suburb']->renderLabel(); ?>: <?php echo $form['suburb']->render(); ?></p>
    <p>
        <?php echo $form['property_type']->renderLabel(); ?>: <?php echo $form['property_type']->render(); ?>

        <?php echo $form['bedrooms']->renderLabel(); ?>: <?php echo $form['bedrooms']->render(); ?>
        <?php echo $form['bathrooms']->renderLabel(); ?>: <?php echo $form['bathrooms']->render(); ?>
        <?php echo $form->renderHiddenFields(false) ?>
        <input type="submit" value="Search" />
    </p>
    </form>
</div>