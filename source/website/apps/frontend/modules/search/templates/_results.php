<br />
<?php    include_partial('global/pagination', array(
    'pager' => $pager,
    'page_url' => $page_url,
    'get_string' => $get_string
)); ?>

<table class="search_listing">
    <?php foreach ($pager->getResults() as $listing) : ?>
    <tr>
        <td>
            <div class="listing">
                <p><?php echo $listing->getName(); ?></p>
                <p><?php echo $listing->getShortDescription(); ?></p>
                <p>Bathrooms: <?php echo $listing->getBathrooms(); ?></p>
                <p>Bedrooms: <?php echo $listing->getBedrooms(); ?></p>
                <p>Car spaces: <?php echo $listing->getCarSpaces(); ?></p>
                <p><?php echo link_to('More details...', $module_link.'/show?id='.$listing->getId()); ?></p>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php    include_partial('global/pagination', array(
    'pager' => $pager,
    'page_url' => $page_url,
    'get_string' => $get_string
)); ?>
