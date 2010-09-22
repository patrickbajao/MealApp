<?php use_helper('Meal') ?>
<ul>
<?php foreach($meals as $meal): ?>
    <li class="meal">
        <span class="counter"><?php echo $meal->getId() ?></span>
        <div class="meal-info">
            <dl>
                <dt>Place: </dt>
                    <dd><?php echo meal_place($meal) ?></dd>
                <dt>Meal: </dt>
                    <dd><?php echo $meal->getType() ?></dd>
                <dt>Created At: </dt>
                    <dd><?php echo date('Y M j g:i', strtotime($meal->getCreatedAt())) ?></dd>
            </dl>
            <span class="links">
                <?php echo meal_links($meal, $user) ?>
            </span>
        </div>
    </li>
<?php endforeach; ?>
</ul>