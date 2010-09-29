<?php use_helper('Meal') ?>
<div class="title">Meals</div>
<div id="meal-list">
    <?php if($sf_user->hasFlash('info')): ?>
        <p class="info"><?php echo $sf_user->getFlash('info') ?></p>
    <?php endif; ?>
    <?php include_partial('meal/list', array('meals' => $meals, 'sunday' => $sunday, 'user' => $sf_user->getGuardUser())) ?>
</div>
<div class="week-nav">
    <?php echo link_to('<span><< Previous Week</span>', '@meals?week=' . ($week - 1), array('class' => 'prev')) ?>
    <?php echo link_to('<span>Current Week</span>', '@meals', array('class' => 'current')) ?>
    <?php echo link_to('<span>Next Week >></span>', '@meals?week=' . ($week + 1), array('class' => 'next')) ?>
</div>