<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('alert/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('alert/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'alert/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['user_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['user_id']->renderError() ?>
          <?php echo $form['user_id'] ?>
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
        <th><?php echo $form['car_spaces']->renderLabel() ?></th>
        <td>
          <?php echo $form['car_spaces']->renderError() ?>
          <?php echo $form['car_spaces'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['suburb']->renderLabel() ?></th>
        <td>
          <?php echo $form['suburb']->renderError() ?>
          <?php echo $form['suburb'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['postcode']->renderLabel() ?></th>
        <td>
          <?php echo $form['postcode']->renderError() ?>
          <?php echo $form['postcode'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['amount_alerted']->renderLabel() ?></th>
        <td>
          <?php echo $form['amount_alerted']->renderError() ?>
          <?php echo $form['amount_alerted'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['active']->renderLabel() ?></th>
        <td>
          <?php echo $form['active']->renderError() ?>
          <?php echo $form['active'] ?>
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
