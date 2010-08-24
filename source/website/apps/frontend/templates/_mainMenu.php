<div id="main_menu">
<ul id="menu">
    <li><a href="<?php url_for('sale/index'); ?>" target="_self" title="Buy" <?php echo ($sf_request->getParameter('module') == 'sale' ? 'class="current"' : '') ?>>Buy</a></li>
<li><a href="" target="_self" title="Rent" <?php echo ($sf_request->getParameter('module') == 'rent' ? 'class="current"' : '') ?>>Rent</a></li>
<li><a href="" target="_self" title="About" <?php echo ($sf_request->getParameter('module') == 'sale' ? 'class="current"' : '') ?>>About</a></li>
<li><a href="" target="_self" title="Contact" <?php echo ($sf_request->getParameter('module') == 'sale' ? 'class="current"' : '') ?>>Contact</a></li>
</ul>
</div>
