<div id="user_context">

<?php if ($sf_user->isAuthenticated()) : ?>

	<?php echo link_to('Profile', 'user/show'); ?> |
	<?php echo link_to('Alerts', 'alert'); ?> |
	<?php echo link_to('Log out', '@sf_guard_signout'); ?> 

<?php else : ?>
	
	<?php echo link_to('Log in', '@sf_guard_signin'); ?> |
	<?php echo link_to('Register', 'user/new'); ?> 
	
<?php endif; ?>
	
</div>

