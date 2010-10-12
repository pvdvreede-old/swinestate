<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('jquery.autocompleter.js') ?>
<?php use_stylesheet('jquery.autocompleter.css') ?>

<div id='search'>
    <?php if ($sf_request->hasParameter('search') && $sf_user->isAuthenticated()) : ?>

    <form action="<?php echo url_for('alert/create'); ?>" method="post" >
        <input type="hidden" name="alert[name]" value="Search for <?php echo time(); ?>" />
        <input type="hidden" name="alert[active]" value="1" />
        <input type="hidden" name="alert[listing_type_id]" value="<?php echo $listing_type_id; ?>" />
    <?php foreach($sf_request->getParameter('search') as $key => $value) : ?>
        <?php if ($value == '0') { $value = null; } ?>
        <?php if ($key == 'suburb') : ?>

        <input type="hidden" name="alert[<?php echo $key; ?>]" value="<?php echo SuburbPeer::getNameFromId($value); ?>" />
        <?php else : ?>
            <input type="hidden" name="alert[<?php echo $key; ?>]" value="<?php echo $value; ?>" />
        <?php endif; ?>
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