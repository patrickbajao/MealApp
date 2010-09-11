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
                <h1 id="logo"><a href="<?php echo url_for('@homepage') ?>" id="logo"><span>LunchApp</span></a></h1>
                <?php if($sf_user->isAuthenticated()): ?>
                <ul id="navbar">
                    <li><a href="<?php echo url_for('@homepage') ?>">Home</a></li>
                    <li><a href="<?php echo url_for('') ?>">Places</a></li>
                    <li><a href="<?php echo url_for('@meals') ?>">Meals</a></li>
                    <li><a href="<?php echo url_for('@sf_guard_signout') ?>">Logout</a></li>
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
