
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
                <p class="listing_title"><?php echo $listing->getName(); ?></p>
                <p class="listing_desc"><?php echo html_entity_decode($listing->getShortDescription()); ?></p>
                <p class="listing_count">Bathrooms: <?php echo $listing->getBathrooms(); ?>
                Bedrooms: <?php echo $listing->getBedrooms(); ?>
                Car spaces: <?php echo $listing->getCarSpaces(); ?></p>
                <p class="listing_link"><?php echo link_to('More details...', $module_link.'/show?id='.$listing->getId()); ?></p>
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
