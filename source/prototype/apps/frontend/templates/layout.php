<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
      <h1>SwinEstate</h1>

      <?php if ($sf_user->isAuthenticated()) : ?>
      <p>Hi, <?php echo $sf_user->getUserName(); ?>    <a href="<?php echo url_for('sfGuardAuth/signout')?>">Logout</a></p>
      <?php endif; ?>
      <p>The place to find real estate to rent or buy.</p>
      <?php echo $sf_content ?>
  </body>
</html>
