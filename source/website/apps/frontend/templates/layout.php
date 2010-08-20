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
        <div id="content">
            <h1>Name and logo here</h1>

            <div id="user_dets">
            <?php if ($sf_user->isAuthenticated()) : ?>

                <p>Welcome, <?php echo $sf_user->getProfile()->getFirstName(); ?> | <?php echo link_to('Profile', '@profile_page'); ?> | <?php echo link_to('Log out', '@sf_guard_signout'); ?></p>

            <?php else : ?>

                    <p><?php echo link_to('Login', '@sf_guard_signin'); ?> | <?php echo link_to('Register', '@register'); ?></p>

            <?php endif; ?>
            </div>
                    <div id="menu">
                        <ul>
                            <li><a href="<?php echo url_for('@homepage'); ?>">Selling</a></li>
                        </ul>
                    </div>

            <?php //include_partial('mainMenu'); ?>
            <?php echo $sf_content ?>

            <div id="footer">
                <p>Footer here</p>
            </div>
        </div>
    </body>
</html>
