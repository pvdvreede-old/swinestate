
<table class="search_listing">
    <?php foreach ($pager->getResults() as $listing) : ?>
    <tr>
        <td>
            <div class="listing">
                <?php echo $listing->getName(); ?>
                <?php echo $listing->getBathrooms(); ?>
                <?php echo $listing->getBedrooms(); ?>
                <?php echo $listing->getCarSpaces(); ?>
                <?php echo link_to('More details...', $module_link.'/show?id='.$listing->getId()); ?>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php    include_partial('global/pagination', array(
    'pager' => $pager,
    'page_url' => $page_url
)); ?>
