<?php use_helper('Meal') ?>
<div class="title">Meals</div>
<div id="meal-list">
    <?php if($sf_user->hasFlash('info')): ?>
        <p class="info"><?php echo $sf_user->getFlash('info') ?></p>
    <?php endif; ?>
    <?php include_partial('meal/scheduled_meals', array('meals' => $meals, 'user' => $sf_user->getGuardUser())) ?>
</div>
<div class="other-meals">
    <?php echo link_to('<span><< Past Meals</span>', '@meal_list?tense=past', array('class' => 'past')) ?>
    <?php echo link_to('<span>Future Meals >></span>', '@meal_list?tense=future', array('class' => 'future')) ?>
</div>