<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
    <div id="wrapper">
        <div id="container">
            <div id="header">
                <h1 id="logo"><?php echo link_to('<span>LunchApp</span>', '@homepage') ?></h1>
                <?php if($sf_user->isAuthenticated()): ?>
                <ul id="navbar">
                    <li><?php echo link_to('Home', '@homepage') ?></li>
                    <li><?php echo link_to('Places', '@homepage') ?></li>
                    <li><?php echo link_to('Meals', '@meals') ?></li>
                    <li><?php echo link_to('Logout', '@sf_guard_signout') ?></li>
                </ul>
                <?php endif; ?>
            </div>
            <div id="content">
                <?php echo $sf_content ?>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</body>
</html>
