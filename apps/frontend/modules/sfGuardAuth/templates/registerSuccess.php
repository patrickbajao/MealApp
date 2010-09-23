<div class="title">Register</div>
<form method="post" id="register">
    <div class="credentials">
        <div>
            <?php echo $form['username']->renderLabel() ?>
            <?php echo $form['username']->render() ?>
        </div>
        <div>
            <?php echo $form['password']->renderLabel() ?>
            <?php echo $form['password']->render() ?>
            <?php echo $form['password']->renderError() ?>
        </div>
        <div>
            <?php echo $form['password_again']->renderLabel() ?>
            <?php echo $form['password_again']->render() ?>
            <?php echo $form['password_again']->renderError() ?>
        </div>
    </div>
    <div class="profile">
        <div>
            <?php echo $form['first_name']->renderLabel() ?>
            <?php echo $form['first_name']->render() ?>
            <?php echo $form['first_name']->renderError() ?>
        </div>
        <div>
            <?php echo $form['last_name']->renderLabel() ?>
            <?php echo $form['last_name']->render() ?>
            <?php echo $form['last_name']->renderError() ?>
        </div>
        <div>
            <?php echo $form['birthday']->renderLabel() ?>
            <?php echo $form['birthday']->render() ?>
        </div>
    </div>
    <?php echo $form['_csrf_token']->render() ?>
    <input type="submit" value="Register" />
</form>