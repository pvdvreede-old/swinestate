<table>
    <?php    foreach ($listings as $listing) : ?>
    <table>
    <tr>
        <td><?php echo $listing->getName(); ?></td>
    </tr>
    <tr>
        <td><?php echo $listing->getAddress(); ?></td>
    </tr>
    </table>
    <?php endforeach; ?>
    


</table>