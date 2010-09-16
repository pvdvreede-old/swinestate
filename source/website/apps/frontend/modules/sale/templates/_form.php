<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php if (!isset($submitValue)) : $submitValue = 'Save';
endif; ?>

<form action="<?php echo url_for($module_link . '/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()) : ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
        <div id="listing_form">
        <div id="main">
        <?php if (!$form->getObject()->isNew()) : ?>
            <p><?php echo $form['listing_status_id']->renderRow(); ?></p>
        <?php endif; ?>    

        <p><?php echo $form['property_type_id']->renderRow(); ?></p>

        <p><?php echo $form['name']->renderRow(); ?></p>

        <p><?php echo $form['description']->renderRow(); ?></p>
        </div>
        <div id="address">
            <?php echo $form['address']->renderRow(); ?>
        </div>

        <div id="details">
            <?php echo $form['sale_details']->renderRow(); ?>
        </div>

        <div id="photos">
            <?php echo $form['photos']->renderRow(); ?>
        </div>
		
		<div id="video">
            <?php echo $form['video']->renderRow(); ?>
        </div>
        </div>

    <?php echo $form->renderHiddenFields(false) ?>
        &nbsp;<a href="<?php echo url_for($back_to); ?>">Back to list</a>
    <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', $module_link . '/delete?id=' . $form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
    <?php endif; ?>
            <input type="submit" value="<?php echo $submitValue; ?>" />
</form>