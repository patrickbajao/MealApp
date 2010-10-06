<?php use_helper('Meal') ?>
<div class="title">Meals</div>
<div id="meal-list">
    <?php include_partial('meal/flashes', array('sf_user' => $sf_user)) ?>
    <?php include_partial('meal/list', array('meals' => $meals, 'week' => $week, 'sunday' => $sunday, 'user' => $sf_user->getGuardUser())) ?>
</div>
<div class="week-nav">
    <?php echo link_to('<span>&laquo; Previous Week</span>', '@meals?week=' . ($week - 1), array('class' => 'prev')) ?>
    <?php echo link_to('<span>Current Week</span>', '@meals', array('class' => 'current')) ?>
    <?php echo link_to('<span>Next Week &raquo;</span>', '@meals?week=' . ($week + 1), array('class' => 'next')) ?>
</div>