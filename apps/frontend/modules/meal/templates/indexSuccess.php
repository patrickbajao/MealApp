<?php use_helper('Meal') ?>
<div class="title">Meals</div>
<div id="meal-list">
    <ul>
    <?php $ctr = 1; ?>
    <?php foreach($meals as $meal): ?>
        <li class="meal">
            <span class="counter"><?php echo $ctr ?></span>
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
                    <?php if(is_null($meal->getPlace())): ?>
                        <?php echo link_to('Vote', 'vote/' . $meal->getId()) ?>
                    <?php else: ?>
                        <?php echo link_to('View Menu', 'menu/' . $meal->getPlaceId()) ?>
                        <?php echo link_to('Order', 'order/' . $meal->getId()) ?>
                    <?php endif; ?>
                </span>
            </div>
        </li>
        <?php $ctr++; ?>
    <?php endforeach; ?>
    </ul>
</div>