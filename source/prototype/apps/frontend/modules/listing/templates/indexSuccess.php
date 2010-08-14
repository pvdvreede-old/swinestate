<h1>Listings List</h1>

<table>
  <thead>
    <tr>
      <th>Listing type</th>
      <th>Action type</th>
      <th>Address</th>
      <th>Name</th>
      <th>Description</th>
      <th>Bedrooms</th>
      <th>Bathrooms</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Listings as $Listing): ?>
    <tr>
      <td><a href="<?php echo url_for('listing/edit?id='.$Listing->getId()) ?>"><?php echo $Listing->getId() ?></a></td>
      <td><?php echo $Listing->getListing()->getName() ?></td>
      <td><?php echo $Listing->getActionTypeId() ?></td>
      <td><?php echo $Listing->getAddressId() ?></td>
      <td><?php echo $Listing->getName() ?></td>
      <td><?php echo $Listing->getDescription() ?></td>
      <td><?php echo $Listing->getBedrooms() ?></td>
      <td><?php echo $Listing->getBathrooms() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('listing/new') ?>">New</a>
