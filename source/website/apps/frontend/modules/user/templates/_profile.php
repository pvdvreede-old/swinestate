<table>
  <tbody>
    <tr>
      <th>User name:</th>
      <td><?php echo $sf_user->getGuardUser()->getUsername(); ?></td>
    </tr>
    <tr>
      <th>First name:</th>
      <td><?php echo $sf_user->getProfile()->getFirstName(); ?></td>
    </tr>
    <tr>
      <th>Last name:</th>
      <td><?php echo $sf_user->getProfile()->getLastName(); ?></td>
    </tr>
    <tr>
      <th>Email address:</th>
      <td><?php echo $sf_user->getProfile()->getEmailAddress(); ?></td>
    </tr>
    <tr>
      <th>Phone number:</th>
      <td><?php echo $sf_user->getProfile()->getPhoneNumber(); ?></td>
    </tr>
  </tbody>
</table>
