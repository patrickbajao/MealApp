<div class="title">Register</div>
<form method="post" id="register">
    <div>
        <?php echo $form['username']->renderLabel() ?>
        <?php echo $form['username']->render() ?>
    </div>
    <div>
        <?php echo $form['password']->renderLabel() ?>
        <?php echo $form['password']->render() ?>
    </div>
    <div>
        <?php echo $form['password_again']->renderLabel() ?>
        <?php echo $form['password_again']->render() ?>
    </div>
    <div>
        <?php echo $form['first_name']->renderLabel() ?>
        <?php echo $form['first_name']->render() ?>
    </div>
    <div>
        <?php echo $form['last_name']->renderLabel() ?>
        <?php echo $form['last_name']->render() ?>
    </div>
    <div>
        <?php echo $form['birthday']->renderLabel() ?>
        <?php echo $form['birthday']->render() ?>
    </div>
    <?php echo $form['_csrf_token']->render() ?>
    <input type="submit" value="Register" />
</form>