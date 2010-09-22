<?php use_helper('Meal') ?>
<div class="title">Meals</div>
<div id="meal-list">
    <?php if($sf_user->hasFlash('info')): ?>
        <p class="info"><?php echo $sf_user->getFlash('info') ?></p>
    <?php endif; ?>
    <?php include_partial('meal/list', array('meals' => $meals, 'user' => $sf_user->getGuardUser())) ?>
</div>