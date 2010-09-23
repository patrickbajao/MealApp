<?php if($sf_user->hasFlash('info')): ?>
    <p class="info"><?php echo $sf_user->getFlash('info') ?></p>
<?php endif; ?>
<div class="title">Home</div>
<h1 id="welcome">Welcome <?php echo $user->getProfile()->getFirstName()?> <?php echo $user->getProfile()->getLastName()?>!</h1>
<div class="subtitle">Meals!</div>
<div id="meal-list">
<?php include_partial('meal/list', array('meals' => $meals, 'user' => $sf_user->getGuardUser())) ?>
</div>