<table>
  <tbody>

    <tr>
      <th>User name:</th>
      <td><?php echo $sf_user->getGuardUser()->getUsername() ?></td>
    </tr>
    <tr>
      <th>Listing type:</th>
      <td><?php echo $Listing->getListingTypeId() ?></td>
    </tr>
    <tr>
      <th>Property type:</th>
      <td><?php echo $Listing->getPropertyTypeId() ?></td>
    </tr>
    <tr>
      <th>Listing status:</th>
      <td><?php echo $Listing->getListingStatusId() ?></td>
    </tr>
    <tr>
      <th>Address:</th>
      <td><?php echo $Listing->getAddressId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $Listing->getName() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $Listing->getDescription() ?></td>
    </tr>
    <tr>
      <th>Bedrooms:</th>
      <td><?php echo $Listing->getBedrooms() ?></td>
    </tr>
    <tr>
      <th>Bathrooms:</th>
      <td><?php echo $Listing->getBathrooms() ?></td>
    </tr>
    <tr>
      <th>Car spaces:</th>
      <td><?php echo $Listing->getCarSpaces() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $Listing->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $Listing->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('user/edit') ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('user/index') ?>">List</a>
