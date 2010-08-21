

<table class="listing">
    <th>Name</th>
    <th>Address</th>
    <th>Created date</th>
    <th></th>
    <?php foreach ($listings as $listing) : ?>
    <tr>
        <td><?php echo link_to($listing->getName(), '@view_single?id=' . $listing->getId()); ?></td>
        <td><?php echo $listing->getAddress(); ?></td>
        <td><?php echo $listing->getCreatedAt(); ?></td>
        <td><?php echo link_to('Edit', '@edit_sale_listing?id='.$listing->getId()); ?></td>
    </tr>    
    <?php endforeach; ?>
</table>
