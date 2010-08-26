<table>
  <tbody>
    <tr>
      <th>Property type:</th>
      <td><?php echo $Listing->getPropertyType()->getName(); ?></td>
    </tr>
    <tr>
      <th>Address:</th>
      <td><?php echo $Listing->getAddress() ?></td>
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
  </tbody>
</table>

<hr />

<?php if ($sf_user->isAuthenticated() && $Listing->getUserId() == $sf_user->getGuardUser()->getId()) : ?>

You are the creator of this listing and can <a href="<?php echo url_for('sale/edit?id='.$Listing->getId()) ?>">edit</a> it.

<?php else : ?>

<?php echo link_to('Notify the seller of your interest', 'sale/index'); ?>

<?php endif; ?>