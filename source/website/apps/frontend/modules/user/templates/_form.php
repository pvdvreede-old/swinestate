<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form method="post" action="<?php echo url_for('@alter_user'); ?>" >
<?php echo $form->renderGlobalErrors(); ?>
<table>
    <?php foreach ($form as $field) : ?>
    <?php if (substr($field->getName(), 0, 1) != '_') : ?>
    <tr>
        <td class="label"><?php echo $field->renderLabel(); ?>: </td>
        <td class="value"><?php echo $field->render(); ?></td>
        <td class="validator_error"><?php echo $field->renderError(); ?></td>
    </tr>
    <?php else : ?>
    <?php echo $field->render(); ?>
    <?php endif; ?>
    <?php endforeach; ?>
    <tr>
        <td><input type="submit" value="<?php echo $action; ?> User" /> </td>
        <td><?php echo link_to('Cancel', '@profile_page'); ?></td>
    </tr>
</table>

</form>
