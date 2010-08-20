
<table>

    <tr>
        <td class="label">Username:</td>
        <td><?php echo $sf_user->getUserName(); ?></td>
    </tr>

     <tr>
        <td class="label">First name:</td>
        <td><?php echo $sf_user->getProfile()->getFirstName(); ?></td>
    </tr>

     <tr>
        <td class="label">Last name:</td>
        <td><?php echo $sf_user->getProfile()->getLastName(); ?></td>
    </tr>

     <tr>
        <td class="label">Email address:</td>
        <td><?php echo $sf_user->getProfile()->getEmailAddress(); ?></td>
    </tr>

    <tr>
        <td class="label">Phone number:</td>
        <td><?php echo $sf_user->getProfile()->getPhoneNumber(); ?></td>
    </tr>
    


</table>
