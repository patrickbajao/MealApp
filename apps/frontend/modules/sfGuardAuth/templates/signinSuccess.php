<div id="login-form">
    <h2 class="title">Login</h2>
    <form action="<?php echo url_for('@openid_signin') ?>" method="post" id="openid">
        <?php if($sf_user->hasFlash('error')): ?>
            <p class="error"><?php echo $sf_user->getFlash('error') ?></p>
        <?php endif; ?>
        <p class="notes">
            Login using your OpenID account.
        </p>
        <div>
            <label for="openid">OpenID</label>
            <input type="text" name="openid" />
        </div>
        <input type="submit" value="Login" />
        <div id="what-is-openid">
            <div class="title">What is OpenId?</div>
            <p>
                OpenID allows you to use an existing account to sign in to multiple websites, without needing to create new passwords.
            </p>
            <p>
                Here are some services that you might be already using:
            </p>
            <ul>
                <li>
                    <?php echo link_to('<span>Google</span>', 'http://www.google.com', array('id' => 'google-link')) ?>
                </li>
                <li>
                    <?php echo link_to('<span>Yahoo!</span>', 'http://www.yahoo.com', array('id' => 'yahoo-link')) ?>
                </li>
            </ul>
        </div>
    </form>
</div>