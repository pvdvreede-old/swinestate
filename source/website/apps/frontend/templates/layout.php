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
        <div id="wrap">
            <h1><?php echo sfConfig::get('app_app_name'); ?></h1>
			
			<?php include_partial('global/userContext'); ?>
			
			<?php include_partial('global/mainMenu'); ?>

            <div id="content">
                <?php echo $sf_content ?>
            </div>
            
            <div id="footer">
                <p>Copyright SwinEstate 2010</p>
                <p>Swinburne Uni Professional Project</p>
                <p>Group 26</p>
            </div>
        </div>
    </body>
</html>
