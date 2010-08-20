<h2><?php echo $action; ?> user</h2>

<?php include_partial('userMenu'); ?>

<?php include_partial('form', array('form' => $form,
                                    'action' => $action)); ?>
