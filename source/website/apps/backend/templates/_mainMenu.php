<div id="main_menu">
<ul id="menu">
    <li><?php echo link_to('Users', '@users'); ?></li>
    <li><?php echo link_to('Listings', 'listing/index'); ?></li>
    <li><?php echo link_to('Payments', 'listing_time/index'); ?></li>
    <li><a href="<?php echo $sf_request->getUriPrefix() . $sf_request->getRelativeUrlRoot(); ?>">Main Site</a></li>
</ul>
</div>
