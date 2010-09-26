<h2>Listings List</h2>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>User</th>
      <th>Listing type</th>
      <th>Property type</th>
      <th>Listing status</th>
      <th>Address</th>
      <th>Name</th>
      <th>Description</th>
      <th>Bedrooms</th>
      <th>Bathrooms</th>
      <th>Car spaces</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $Listing): ?>
    <tr>
      <td><a href="<?php echo url_for('sale/show?id='.$Listing->getId()) ?>"><?php echo $Listing->getId() ?></a></td>
      <td><?php echo $Listing->getUserId() ?></td>
      <td><?php echo $Listing->getListingTypeId() ?></td>
      <td><?php echo $Listing->getPropertyTypeId() ?></td>
      <td><?php echo $Listing->getListingStatusId() ?></td>
      <td><?php echo $Listing->getAddressId() ?></td>
      <td><?php echo $Listing->getName() ?></td>
      <td><?php echo $Listing->getDescription() ?></td>
      <td><?php echo $Listing->getBedrooms() ?></td>
      <td><?php echo $Listing->getBathrooms() ?></td>
      <td><?php echo $Listing->getCarSpaces() ?></td>
      <td><?php echo $Listing->getCreatedAt() ?></td>
      <td><?php echo $Listing->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php    include_partial('global/pagination', array(
    'pager' => $pager,
    'page_url' => $page_url
)); ?>

  <a href="<?php echo url_for('sale/new') ?>">New</a>
