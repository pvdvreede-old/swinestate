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

    You are the creator of this listing and can <a href="<?php echo url_for('sale/edit?id=' . $Listing->getId()) ?>">edit</a> it.

<?php elseif (!$sf_user->isAuthenticated()) : ?>

        If you are interested in this house, you must <?php echo link_to('Register', 'user/new'); ?> or <?php echo link_to('Log in', '@sf_guard_signin'); ?> to notify the seller of your interest.

<?php else: ?>

<?php if ($sf_user->getProfile()->hasInterestIn($Listing->getId())) : ?>

                You have registered your interest in this listing.
                <form action="<?php echo url_for('sale/withdraw') ?>" method="post">

                    <input type="hidden" name="listing_id" value="<?php echo $Listing->getId(); ?>" />
                    <input type="submit" value="Withdraw your interest." />

                </form>

<?php else : ?>

                    <form action="<?php echo url_for('sale/interest') ?>" method="post">

                        <input type="hidden" name="listing_id" value="<?php echo $Listing->getId(); ?>" />
                        <input type="submit" value="Notify Seller of your interest." />

                    </form>

<?php endif; ?>
<?php endif; ?>