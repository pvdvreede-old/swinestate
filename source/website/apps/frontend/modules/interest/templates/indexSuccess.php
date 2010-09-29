<h2>Buyers interested</h2>

<?php if ($singleListing) : ?>
<?php $results = $pager->getResults(); ?>
<h3>For <?php echo $results[0]->getListing(); ?></h3>
<?php endif; ?>

<p>Here are the details of the users that are interested in your listing. It is up to you to contact there users if you are interested in dealing with them.</p>

<table class="index_list">
  <thead>
    <tr>
      <?php echo (!$singleListing ? '<th>Listing</th>' : ''); ?>
      <th>User Name</th>
      <th>Email address</th>
      <th>Date of Interest</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $Interest) : ?>
    <tr>
      <?php echo (!$singleListing ? '<td>'.$Interest->getListing().'</td>' : ''); ?>
      <td><?php echo $Interest->getUserNameForInterest(); ?></td>
      <td><?php echo $Interest->getUserEmailForInterest(); ?></td>
      <td><?php echo $Interest->getCreatedAt(); ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php    include_partial('global/pagination', array(
    'pager' => $pager,
    'page_url' => $page_url
)); ?>

<?php echo link_to('Back to Listings', 'listing/index'); ?>
