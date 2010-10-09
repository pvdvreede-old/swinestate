<h1>Alerts List</h1>

<?php if ($pager->count() == 0) : ?>

<p>You do not have any alerts. Create a new one below.</p>

<?php else :?>

<table class="index_list">
  <thead>
    <tr>
      <th>Name</th>
      <th>Bedrooms</th>
      <th>Bathrooms</th>
      <th>Car spaces</th>
      <th>Suburb</th>
      <th>Postcode</th>
      <th>Amount alerted</th>
      <th>Active</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $Alert): ?>
    <tr>
      <td><a href="<?php echo url_for('alert/edit?id='.$Alert->getId()) ?>"><?php echo $Alert->getName() ?></a></td>
      <td><?php echo $Alert->getBedrooms() ?></td>
      <td><?php echo $Alert->getBathrooms() ?></td>
      <td><?php echo $Alert->getCarSpaces() ?></td>
      <td><?php echo $Alert->getSuburb() ?></td>
      <td><?php echo $Alert->getPostcode() ?></td>
      <td><?php echo $Alert->getAmountAlerted() ?></td>
      <td><?php echo $Alert->getActive() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php    include_partial('global/pagination', array(
    'pager' => $pager,
    'page_url' => $page_url
)); ?>

<?php endif; ?>

  <a href="<?php echo url_for('alert/new') ?>">New</a>
