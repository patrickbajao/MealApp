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
<?php $days = 0; $prev = 1; ?>
<?php while($days <= 6): ?>
    <?php $no_meal = false ?>
    <?php $date = date('F j, Y', strtotime('+' . $days . ' days', strtotime($sunday))) ?>
    <?php $meal = $meals->current(); ?>

    <?php if($meal != false): ?>
        <?php if($date == date('F j, Y', strtotime($meal->getScheduledAt()))): ?>
            <?php if($prev != $days): ?><div class="date <?php echo ($days == 0) ? 'first' : '' ; ?>"><?php echo $date ?></div><?php endif; ?>
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
            <?php $prev = $days ?>
            <?php $meals->next(); ?>
        <?php else: ?>
            <?php $no_meal = true ?>
        <?php endif; ?>
    <?php else:?>
        <?php $no_meal = true ?>
    <?php endif; ?>
    <?php if($no_meal): ?>
        <?php if($prev != $days): ?>
            <div class="date <?php echo ($days == 0) ? 'first' : '' ; ?>"><?php echo $date ?></div>
            <li class="no-meal">No meals scheduled for this day yet.</li>
        <?php endif; ?>
        <?php $days++ ?>
    <?php endif; ?>
<?php endwhile; ?>
</ul>