<div class="title">Home</div>
<?php if($sf_user->hasFlash('info')): ?>
    <p class="info"><?php echo $sf_user->getFlash('info') ?></p>
<?php endif; ?>
<h1 id="welcome">Welcome <?php echo $user->getProfile()->getFirstName()?> <?php echo $user->getProfile()->getLastName()?>!</h1>
<div class="subtitle">Scheduled Meal</div>
<div id="meal-list">
<?php include_partial('meal/scheduled_meals', array('meal' => $meal, 'user' => $sf_user->getGuardUser())) ?>
</div>