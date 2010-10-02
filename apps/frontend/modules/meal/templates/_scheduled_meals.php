<?php use_helper('Meal') ?>
<div class="legend">
    <span>Legend: </span>
    <dl>
        <dt>Breakfast</dt>
            <dd class="breakfast"><?php echo image_tag('meal-bfast-icon.gif') ?></dd>
        <dt>Lunch</dt>
            <dd class="lunch"><?php echo image_tag('meal-lunch-icon.gif') ?></dd>
        <dt>Dinner</dt>
            <dd class="dinner"><?php echo image_tag('meal-dinner-icon.gif') ?></dd>
</div>
<div id="scheduled-meal">
    <?php if(!empty($meal)): ?>
        <div class="<?php echo $meal->getType() ?>">
            <div class="icon"><?php echo meal_icon($meal) ?></div>
            <dl>
                <dt><strong>Place: </strong></dt>
                    <dd><?php echo meal_place($meal) ?></dd>
                <dt><strong>Time Scheduled: </strong></dt>
                    <dd><?php echo date('g:i a', strtotime($meal->getScheduledAt())) ?></dd>
            </dl>
            <span class="status">
                <?php echo meal_status($meal, $user) ?>
            </span>
            <span class="links">
                <?php echo meal_links($meal, $user) ?>
            </span>
        </div>
    <?php else: ?>
        <div class="no-meal">No meals scheduled yet.</div>
    <?php endif; ?>
</div>