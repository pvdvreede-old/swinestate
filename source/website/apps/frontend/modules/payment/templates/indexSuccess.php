<h1>ListingTimes List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>User</th>
      <th>Listing</th>
      <th>Start date</th>
      <th>End date</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ListingTimes as $ListingTime): ?>
    <tr>
      <td><a href="<?php echo url_for('payment/show?id='.$ListingTime->getId()) ?>"><?php echo $ListingTime->getId() ?></a></td>
      <td><?php echo $ListingTime->getUserId() ?></td>
      <td><?php echo $ListingTime->getListingId() ?></td>
      <td><?php echo $ListingTime->getStartDate() ?></td>
      <td><?php echo $ListingTime->getEndDate() ?></td>
      <td><?php echo $ListingTime->getCreatedAt() ?></td>
      <td><?php echo $ListingTime->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('payment/new') ?>">New</a>
