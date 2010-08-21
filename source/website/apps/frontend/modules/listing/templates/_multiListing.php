<table class="listing">
    <?php foreach ($listings as $listing) : ?>
    <tr><td>
    <table class="listing">
            <tr>
                <td><?php echo $listing->getName(); ?></td>
                <td>Bed: <?php echo $listing->getBedrooms(); ?></td>
                <td>Bath: <?php echo $listing->getBathrooms(); ?></td>
            </tr>
            <tr>
                <td><?php echo $listing->getAddress(); ?></td>
                <td><?php echo link_to('More Details', '@view_single?id=' . $listing->getId()); ?></td>
            </tr>
        </table>
    </td></tr>
    <?php endforeach; ?>
</table>