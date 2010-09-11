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
                <h1 id="logo"><a href="<?php echo url_for('@homepage') ?>"><span>LunchApp</span></a></h1>
            </div>
            <div id="content">
                <?php echo $sf_content ?>
            </div>
        </div>
    </div>
</body>
</html>