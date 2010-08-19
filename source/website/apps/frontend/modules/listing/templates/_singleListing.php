<table>

    <tr>
        <td><?php echo $listing->getName(); ?></td>
        <td>Bed: <?php echo $listing->getBedrooms(); ?></td>
        <td>Bath: <?php echo $listing->getBathrooms(); ?></td>
    </tr>
    <tr>
        <td><?php echo $listing->getAddress(); ?></td>
    </tr>
    <tr>
        <td><?php echo $listing->getDescription(); ?></td>
    </tr>


</table>
