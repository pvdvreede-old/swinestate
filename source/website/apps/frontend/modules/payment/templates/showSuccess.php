<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $ListingTime->getId() ?></td>
    </tr>
    <tr>
      <th>User:</th>
      <td><?php echo $ListingTime->getUserId() ?></td>
    </tr>
    <tr>
      <th>Listing:</th>
      <td><?php echo $ListingTime->getListingId() ?></td>
    </tr>
    <tr>
      <th>Start date:</th>
      <td><?php echo $ListingTime->getStartDate() ?></td>
    </tr>
    <tr>
      <th>End date:</th>
      <td><?php echo $ListingTime->getEndDate() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $ListingTime->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $ListingTime->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />


<a href="<?php echo url_for('payment/index') ?>">List</a>
