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
<ul>
    <li class="day">
        <span class="date"><?php echo date('F j, Y') ?></span>
        <ul class="meals">
        <?php if($meals->count() > 0): ?>
            <?php foreach($meals as $meal): ?>
                <li class="<?php echo $meal->getType() ?>">
                    <div class="icon"><?php echo meal_icon($meal) ?></div>
                    <dl>
                        <dt><strong>Place: </strong></dt>
                            <dd><?php echo meal_place($meal) ?></dd>
                        <dt><strong>Time Scheduled: </strong></dt>
                            <dd><?php echo date('g:i a', strtotime($meal->getScheduledAt())) ?></dd>
                    </dl>
                    <span class="links">
                        <?php echo meal_links($meal, $user) ?>
                    </span>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="no-meal">No meals scheduled for this day yet.</li>
        <?php endif; ?>
        </ul>
    </li>
</ul>