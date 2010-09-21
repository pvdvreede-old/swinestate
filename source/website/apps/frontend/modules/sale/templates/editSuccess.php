<h2>Edit Listing</h2>

<?php include_partial('global/form', array(
    'form' => $form,
    'module_link' => 'sale',
    'back_to' => 'listing/index'
        )) ?>

<?php link_to('Add photos to this listing', 'photos/new?id='.$form->getObject()->getId()); ?>
