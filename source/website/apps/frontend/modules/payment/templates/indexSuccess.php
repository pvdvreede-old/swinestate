<h1>Payment History</h1>

<?php if ($singleListing) : ?>
<?php $results = $pager->getResults(); ?>
<h2>For <?php echo $results[0]->getListing(); ?></h2>
<?php endif; ?>

<table class="index_list">
  <thead>
    <tr>
      <?php echo (!$singleListing ? '<th>Listing</th>' : ''); ?>
      <th>Start date</th>
      <th>End date</th>
      <th>Date Paid</th>
      <th>PayPal Account</th>
      <th>Amount</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $ListingTime): ?>
    <tr>
      <?php echo (!$singleListing ? '<td>'.$ListingTime->getListing().'</td>' : ''); ?>
      <td><?php echo $ListingTime->getStartDate() ?></td>
      <td><?php echo $ListingTime->getEndDate() ?></td>
      <td><?php echo $ListingTime->getPaymentDate() ?></td>
      <td><?php echo $ListingTime->getPayerAccountName() ?></td>
      <td>$<?php echo $ListingTime->getTotalPaid() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php    include_partial('global/pagination', array(
    'pager' => $pager,
    'page_url' => $page_url
)); ?>

<?php echo link_to('Back to Listings', 'listing/index'); ?>
