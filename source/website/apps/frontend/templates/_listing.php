<?php if ($pager->count() == 0) : ?>

<p><?php echo $empty_result_text; ?></p>

<?php else : ?>

<table class="index_list">
  <thead>
    <tr>
      <?php foreach ($headings as $heading) : ?>
      <th><?php echo $heading; ?></th>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $item): ?>
    <tr>
        <?php foreach ($column as $c) : ?>
        <td><?php echo $item->$c; ?></td>

      <td><?php echo link_to($Listing->getName() , strtolower($Listing->getListingType()->getName()).'/edit?id='.$Listing->getId()); ?></td>
      <td><?php echo $Listing->getListingType()->getName() ?></td>
      <td><?php echo $Listing->getPropertyType()->getName() ?></td>
      <td><?php echo $Listing->getListingStatus()->getName() ?></td>
      <td><?php echo $Listing->getAddress() ?></td>
      <td><?php echo $Listing->getBedrooms() ?></td>
      <td><?php echo $Listing->getBathrooms() ?></td>
      <td><?php echo $Listing->getCarSpaces() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php    include_partial('global/pagination', array(
    'pager' => $pager,
    'page_url' => $page_url
)); ?>

<?php endif; ?>
