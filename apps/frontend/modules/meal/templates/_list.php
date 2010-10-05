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
<?php $days = 0; ?>
<?php while($days <= 6): ?>
    <li class="day <?php echo meal_date($sunday, $days) == date('F j, Y') ? 'current' : '' ; ?>">
        <span class="date"><?php echo meal_date($sunday, $days) ?>, <strong><?php echo date('l', strtotime(meal_date($sunday, $days))) ?></strong></span>
        <ul class="meals">
        <?php $no_meal = true ?>
        <?php foreach($meals as $meal): ?>
            <?php if(meal_date($sunday, $days) == date('F j, Y', strtotime($meal->getScheduledAt()))): ?>
                <li class="meal <?php echo $meal->getType() ?>" id="meal-<?php echo $meal->getId() ?>">
                    <div>
                        <div class="icon"><?php echo meal_icon($meal) ?></div>
                        <dl>
                            <dt><strong>Place: </strong></dt>
                                <dd><?php echo meal_place($meal) ?></dd>
                            <dt><strong>Time Scheduled: </strong></dt>
                                <dd><?php echo date('g:i a', strtotime($meal->getScheduledAt())) ?></dd>
                        </dl>
                        <span class="links">
                            <?php echo meal_links($meal, $user, ($week != 0) ? 'meals.week=' . $week :  'meals') ?>
                        </span>
                    </div>
                </li>
                <?php $no_meal = false ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php if($no_meal): ?>
            <li class="no-meal">No meals scheduled for this day yet.</li>
        <?php endif; ?>
        </ul>
    </li>
    <?php $days++ ?>
<?php endwhile; ?>
</ul>