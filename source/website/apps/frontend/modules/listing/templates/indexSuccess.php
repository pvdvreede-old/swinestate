<h2>User's Listings</h2>

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
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php    include_partial('global/pagination', array(
    'pager' => $pager,
    'page_url' => $page_url
)); ?>

<?php endif; ?>

  <a href="<?php echo url_for('sale/new') ?>">New Sale Listing</a>

  <a href="<?php echo url_for('rent/new') ?>">New Rental Listing</a>

  <?php echo link_to('See payment history for all listings', 'payment/index'); ?>
