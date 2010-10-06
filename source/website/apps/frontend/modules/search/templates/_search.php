<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div id='search'>
    <?php if ($sf_request->hasParameter('search') && $sf_user->isAuthenticated()) : ?>

    <form action="<?php echo url_for('alert/create'); ?>" method="post" >
        <input type="hidden" name="alert[name]" value="Search for <?php echo time(); ?>" />
        <input type="hidden" name="alert[active]" value="1" />
    <?php foreach($sf_request->getParameter('search') as $key => $value) : ?>
        <?php if ($value == '0') { $value = null; } ?>

    <input type="hidden" name="alert[<?php echo $key; ?>]" value="<?php echo $value; ?>" />
    <?php endforeach; ?>
        <input type="submit" value="Add this search to my alerts" />
        </form>

    <?php endif; ?>
    <form action="<?php echo url_for('search'.'/'.$module_link) ?>" method="get" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php echo $form->renderGlobalErrors() ?>
    <p><?php echo $form['suburb']->renderLabel(); ?>: <?php echo $form['suburb']->render(); ?> <?php echo $form['suburb']->renderError(); ?> <strong>OR</strong> <?php echo $form['postcode']->renderLabel(); ?>: <?php echo $form['postcode']->render(); ?> <?php echo $form['postcode']->renderError(); ?></p>
    <p>
        <?php echo $form['property_type']->renderLabel(); ?>: <?php echo $form['property_type']->render(); ?> <?php echo $form['property_type']->renderError(); ?>

        <?php echo $form['bedrooms']->renderLabel(); ?>: <?php echo $form['bedrooms']->render(); ?> <?php echo $form['bedrooms']->renderError(); ?>
        <?php echo $form['bathrooms']->renderLabel(); ?>: <?php echo $form['bathrooms']->render(); ?> <?php echo $form['bathrooms']->renderError(); ?>
        <?php echo $form['min_price']->renderLabel(); ?>: <?php echo $form['min_price']->render(); ?> <?php echo $form['min_price']->renderError(); ?>
        <?php echo $form['max_price']->renderLabel(); ?>: <?php echo $form['max_price']->render(); ?> <?php echo $form['max_price']->renderError(); ?>
        <?php echo $form->renderHiddenFields(false) ?>
        <input type="submit" value="Search" />
        </p>
    </form>
    

</div>