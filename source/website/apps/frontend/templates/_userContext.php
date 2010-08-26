<div id="user_context">

<?php if ($sf_user->isAuthenticated()) : ?>

	<?php echo 'Welcome back, '.($sf_user->getProfile()->getFirstName() == '' ? $sf_user->getGuardUser()->getUsername() : $sf_user->getProfile()->getFirstName()); ?> |
        <?php echo link_to('Profile', 'user/show'); ?> |
        <?php echo link_to('Listings', 'listing/index'); ?> |
	<?php echo link_to('Alerts', 'alert/index'); ?> |
	<?php echo link_to('Log out', '@sf_guard_signout'); ?> 

<?php else : ?>
	
	<?php echo link_to('Log in', '@sf_guard_signin'); ?> |
	<?php echo link_to('Register', 'user/new'); ?> 
	
<?php endif; ?>
	
</div>

