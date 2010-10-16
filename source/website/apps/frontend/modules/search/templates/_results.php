<?php if (count($pager) < 1) : ?>

<?php if ($sf_request->hasParameter('search')) : ?>

    <form action="<?php echo url_for('alert/create'); ?>" method="post" >
        <input type="hidden" name="alert[name]" value="Search for <?php echo time(); ?>" />
        <input type="hidden" name="alert[active]" value="1" />
    <?php foreach($sf_request->getParameter('search') as $key => $value) : ?>
        <?php if ($value == '0') { $value = null; } ?>
      
    <input type="hidden" name="alert[<?php echo $key; ?>]" value="<?php echo $value; ?>" />
    <?php endforeach; ?>
        <p>There were no results found for this query, if you have signed up you can add this search to your alerts to be notified of a listing matchin this description.</p>
        </form>

    <?php endif; ?>


<?php else : ?>
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
                <?php if ($listing->hasPhoto()) : ?>
                <div class="photo">
                    
                    <?php echo image_tag($sf_request->getUriPrefix() . $sf_request->getRelativeUrlRoot() . '/uploads/listings/thumb/' . $listing->getFirstPhotoPath()); ?>
                    
                </div>
                <?php endif; ?>
                <p class="listing_title"><?php echo $listing->getName(); ?></p>
                <p class="address"><?php echo $listing->getAddress(); ?></p>
                <p class="listing_desc"><?php echo html_entity_decode($listing->getShortDescription()); ?></p>
                <div class="listing_count"><div class="bath_pic"><?php echo $listing->getBathrooms(); ?></div> 
                <div class="bed_pic"><?php echo $listing->getBedrooms(); ?></div>
                <div class="car_pic"><?php echo $listing->getCarSpaces(); ?></div></div>
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

<?php endif; ?>