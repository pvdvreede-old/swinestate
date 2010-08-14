<h1>Listings List</h1>

<table>
  <thead>
    <tr>

      <th>Listing type</th>
      <th>Action type</th>
      <th>Address</th>
      <th>Name</th>
      <th>Bedrooms</th>
      <th>Bathrooms</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($Listings as $Listing): ?>
    <tr>
      <td><?php echo $Listing->getListingType()->getName() ?></td>
      <td><?php echo $Listing->getActionType()->getName() ?></td>
      <td><?php $add = $Listing->getAddress();
                echo $add->getStreetNumber().' '.$add->getStreetName(); ?></td>
      <td><a href='<?php echo url_for('listing/view?id='.$Listing->getId()); ?>'><?php echo $Listing->getName() ?></a></td>
      <td><?php echo $Listing->getBedrooms() ?></td>
      <td><?php echo $Listing->getBathrooms() ?></td>

    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('listing/new') ?>">New</a>
