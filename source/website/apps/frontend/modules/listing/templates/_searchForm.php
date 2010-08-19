<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div id='search'>
    <?php echo $form->renderFormTag('listing/search'); ?>
    <?php echo $form->renderGlobalErrors() ?>
    <p><?php echo $form['suburb']->renderLabel(); ?>: <?php echo $form['suburb']->render(); ?></p>
    <p>
        <?php echo $form['listing_type']->renderLabel(); ?>: <?php echo $form['listing_type']->render(); ?>

        <?php echo $form['bedrooms']->renderLabel(); ?>: <?php echo $form['bedrooms']->render(); ?>
        <?php echo $form['bathrooms']->renderLabel(); ?>: <?php echo $form['bathrooms']->render(); ?>
        <input type="submit" value="Search" />
    </p>
    </form>
</div>






