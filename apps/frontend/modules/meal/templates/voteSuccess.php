<?php use_helper('Meal') ?>
<div class="title">Vote</div>
<?php if($sf_user->hasFlash('info')): ?>
    <p class="info"><?php echo $sf_user->getFlash('info') ?></p>
<?php endif; ?>
<form method="post" id="place-vote">
    <?php echo $form['id']->render() ?>
    <?php echo $form['place_id']->render() ?>
    <?php echo $form['_csrf_token']->render() ?>
    <div class="buttons">
        <input type="submit" value="Place Vote" />
    </div>
</form>