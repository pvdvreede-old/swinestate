<h2>Profile</h2>

<?php include_partial('userMenu'); ?>

<?php include_partial('profile', array('sf_user' => $sf_user)); ?>

<h2>Current Listings</h2>

<?php include_partial('listings', array('listings' => $active_user_listings));