<h1>Alerts List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>User</th>
      <th>Bedrooms</th>
      <th>Bathrooms</th>
      <th>Car spaces</th>
      <th>Suburb</th>
      <th>Postcode</th>
      <th>Amount alerted</th>
      <th>Active</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Alerts as $Alert): ?>
    <tr>
      <td><a href="<?php echo url_for('alert/show?id='.$Alert->getId()) ?>"><?php echo $Alert->getId() ?></a></td>
      <td><?php echo $Alert->getUserId() ?></td>
      <td><?php echo $Alert->getBedrooms() ?></td>
      <td><?php echo $Alert->getBathrooms() ?></td>
      <td><?php echo $Alert->getCarSpaces() ?></td>
      <td><?php echo $Alert->getSuburb() ?></td>
      <td><?php echo $Alert->getPostcode() ?></td>
      <td><?php echo $Alert->getAmountAlerted() ?></td>
      <td><?php echo $Alert->getActive() ?></td>
      <td><?php echo $Alert->getCreatedAt() ?></td>
      <td><?php echo $Alert->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('alert/new') ?>">New</a>
