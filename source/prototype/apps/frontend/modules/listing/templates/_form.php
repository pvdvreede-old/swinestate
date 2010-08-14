<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('listing/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('listing/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'listing/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['listing_type_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['listing_type_id']->renderError() ?>
          <?php echo $form['listing_type_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['action_type_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['action_type_id']->renderError() ?>
          <?php echo $form['action_type_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['address_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['address_id']->renderError() ?>
          <?php echo $form['address_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['description']->renderLabel() ?></th>
        <td>
          <?php echo $form['description']->renderError() ?>
          <?php echo $form['description'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['bedrooms']->renderLabel() ?></th>
        <td>
          <?php echo $form['bedrooms']->renderError() ?>
          <?php echo $form['bedrooms'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['bathrooms']->renderLabel() ?></th>
        <td>
          <?php echo $form['bathrooms']->renderError() ?>
          <?php echo $form['bathrooms'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
