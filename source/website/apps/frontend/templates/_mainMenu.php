<div id="main_menu">
<ul id="menu">
    <li><a href="<?php echo url_for('search/sale'); ?>" target="_self" title="Buy" <?php echo ($sf_request->getParameter('action') == 'sale' || $sf_request->getParameter('module') == 'sale' ? 'class="current"' : '') ?>>Buy</a></li>
    <li><a href="<?php echo url_for('search/rent'); ?>" target="_self" title="Rent" <?php echo ($sf_request->getParameter('action') == 'rent' ? 'class="current"' : '') ?>>Rent</a></li>
    <li><a href="" target="_self" title="About">About</a></li>
    <li><a href="" target="_self" title="Contact">Contact</a></li>
</ul>
</div>
