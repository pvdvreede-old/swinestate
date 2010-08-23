<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $Alert->getId() ?></td>
    </tr>
    <tr>
      <th>User:</th>
      <td><?php echo $Alert->getUserId() ?></td>
    </tr>
    <tr>
      <th>Bedrooms:</th>
      <td><?php echo $Alert->getBedrooms() ?></td>
    </tr>
    <tr>
      <th>Bathrooms:</th>
      <td><?php echo $Alert->getBathrooms() ?></td>
    </tr>
    <tr>
      <th>Car spaces:</th>
      <td><?php echo $Alert->getCarSpaces() ?></td>
    </tr>
    <tr>
      <th>Suburb:</th>
      <td><?php echo $Alert->getSuburb() ?></td>
    </tr>
    <tr>
      <th>Postcode:</th>
      <td><?php echo $Alert->getPostcode() ?></td>
    </tr>
    <tr>
      <th>Amount alerted:</th>
      <td><?php echo $Alert->getAmountAlerted() ?></td>
    </tr>
    <tr>
      <th>Active:</th>
      <td><?php echo $Alert->getActive() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $Alert->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $Alert->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('alert/edit?id='.$Alert->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('alert/index') ?>">List</a>
