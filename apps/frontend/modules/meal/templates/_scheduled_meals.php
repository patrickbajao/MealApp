<?php use_helper('Meal') ?>
<div class="legend">
    <span>Legend: </span>
    <dl>
        <dt>Breakfast</dt>
            <dd><?php echo image_tag('meal-bfast-icon.gif') ?></dd>
        <dt>Lunch</dt>
            <dd><?php echo image_tag('meal-lunch-icon.gif') ?></dd>
        <dt>Dinner</dt>
            <dd><?php echo image_tag('meal-dinner-icon.gif') ?></dd>
</div>
<ul>
    <div class="date"><?php echo date('F j, Y') ?></div>
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
</ul>