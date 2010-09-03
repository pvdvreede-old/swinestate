<p><a href="<?php echo url_for('search/sale').'?'.$sf_user->getFlash('last_url'); ?>">Back to search results</a></p>
<div class="single_listing">
    <h2 class="title"><?php echo $Listing->getName(); ?></h2>
    <p class="rooms">ba: <?php echo $Listing->getBathrooms(); ?> be: <?php echo $Listing->getBedrooms(); ?> ca: <?php echo $Listing->getCarSpaces(); ?></p>
    <p class="address"><?php echo $Listing->getAddress(); ?></p>
    <p class="description"><?php echo $Listing->getDescription(); ?></p>
</div>

<hr />

<?php if ($sf_user->isAuthenticated() && $Listing->getUserId() == $sf_user->getGuardUser()->getId()) : ?>

    You are the creator of this listing and can <a href="<?php echo url_for('sale/edit?id=' . $Listing->getId()) ?>">edit</a> it.

<?php elseif (!$sf_user->isAuthenticated()) : ?>

        If you are interested in this house, you must <?php echo link_to('Register', 'user/new'); ?> or <?php echo link_to('Log in', '@sf_guard_signin'); ?> to notify the seller of your interest.

<?php else: ?>

<?php if ($sf_user->getProfile()->hasInterestIn($Listing->getId())) : ?>

                
                <form action="<?php echo url_for('sale/withdraw') ?>" method="post">

                    <input type="hidden" name="listing_id" value="<?php echo $Listing->getId(); ?>" />
                    You have registered your interest in this listing.
                    <input type="submit" value="Withdraw your interest." />

                </form>

<?php else : ?>

                    <form action="<?php echo url_for('sale/interest') ?>" method="post">

                        <input type="hidden" name="listing_id" value="<?php echo $Listing->getId(); ?>" />
                        <input type="submit" value="Notify Seller of your interest." />

                    </form>

<?php endif; ?>
<?php endif; ?>