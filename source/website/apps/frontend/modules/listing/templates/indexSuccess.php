<h2>User's Listings</h2>

<p>

  <a href="<?php echo url_for('sale/new') ?>">New Sale Listing</a> |

  <a href="<?php echo url_for('rent/new') ?>">New Rental Listing</a>

  <?php if (ListingTimePeer::hasPayments()) { echo ' | '.link_to('See all listing payments', 'payment/index'); } ?>

  <?php if (InterestPeer::hasInterests()) { echo ' | '.link_to('See all interests', 'interest/index'); } ?>

  <?php echo (ListingTimePeer::getPendingPaymentCount() > 0 ? '| '.link_to('You have '.ListingTimePeer::getPendingPaymentCount().' payment(s) pending', 'listing/index') : '') ?>

</p>

<?php if ($pager->count() == 0) : ?>

<p>You do not have any listings. Create a new one below.</p>

<?php else :?>

<table class="index_list">
  <thead>
    <tr>
      <th>Name</th>
      <th>Listing type</th>
      <th>Property type</th>     
      <th>Address</th>     
      <th>Listing status</th>
      <th>View status</th>
      <th>Payment history</th>
      <th>Interests</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $Listing): ?>
    <tr>
      <td><?php echo link_to($Listing->getName() , strtolower($Listing->getListingType()->getName()).'/edit?id='.$Listing->getId()); ?></td>
      <td><?php echo $Listing->getListingType()->getName() ?></td>
      <td><?php echo $Listing->getPropertyType()->getName() ?></td>
      <td><?php echo $Listing->getAddress() ?></td>
      <td><?php echo $Listing->getListingStatus()->getName() ?></td>
      <td><?php echo html_entity_decode($Listing->getViewStatus()); ?></td>
      <td><?php echo ($Listing->getPaymentHistory() ? link_to('Click here', 'payment/index?id='.$Listing->getId()) : 'None'); ?></td>
      <td><?php echo ($Listing->getInterestsCount() > 0 ? link_to($Listing->getInterestsCount(), 'interest/index?id='.$Listing->getId()) : $Listing->getInterestsCount()); ?></td>
      <td><?php echo link_to('Preview', $Listing->getListingTypeName().'/show?id='.$Listing->getId()); ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php    include_partial('global/pagination', array(
    'pager' => $pager,
    'page_url' => $page_url
)); ?>

<?php endif; ?>


