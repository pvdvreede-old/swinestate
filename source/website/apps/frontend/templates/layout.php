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
            <h1><?php echo sfConfig::get('app_app_name'); ?></h1>

            <div id="user_dets">
            <?php if ($sf_user->isAuthenticated()) : ?>

                <p>Welcome, <?php echo $sf_user->getProfile()->getFirstName(); ?> | <?php echo link_to('Profile', '@profile_page'); ?> | <?php echo link_to('Log out', '@sf_guard_signout'); ?></p>

            <?php else : ?>

                    <p><?php echo link_to('Login', '@sf_guard_signin'); ?> | <?php echo link_to('Register', '@register'); ?></p>

            <?php endif; ?>
            </div>
                    <div id="main_menu">
                        <p>
                            <span class="button"><?php echo link_to('Selling', '@homepage'); ?></span>
                            <span class="button"><?php echo link_to('Renting', '@rent_homepage'); ?>  </span>
                            <span class="button"><?php echo link_to('About', '@about'); ?></span>
                            <span class="button"><?php echo link_to('Contact', '@contact'); ?></span>
                        </p>
                    </div>

            <?php //include_partial('mainMenu'); ?>
            <?php echo $sf_content ?>

            <div id="footer">
                <p>Footer here</p>
            </div>
        </div>
    </body>
</html>
