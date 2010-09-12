<h2>New Listing payment</h2>

<?php include_partial('global/form', array(
    'form' => $form,
    'module_link' => 'payment',
    'submitValue' => 'Create payment',
    'back_to' => 'listing/index'
));
