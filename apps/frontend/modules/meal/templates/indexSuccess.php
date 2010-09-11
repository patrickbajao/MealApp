<p class="title">Meals</p>
<div id="meal-list">
    <ul>
    <?php $ctr = 1; ?>
    <?php foreach($meals as $meal): ?>
        <li class="meal">
            <h1><?php echo $ctr ?></h1>
            <div class="meal-info">
                <?php $place = (!is_null($meal->getPlace())) ? $meal->getPlace()->getName() : 'None' ; ?>
                <span class="place"><strong>Place: </strong><?php echo $place ?></span>
                <span class="type"><strong>Meal: </strong><?php echo $meal->getType() ?></span>
                <span class="links">
                    <?php if(is_null($meal->getPlace())): ?>
                        <a href="<?php echo url_for('vote/' . $meal->getId()) ?>">Vote</a>
                    <?php else: ?>
                        <a href="<?php echo url_for('menu/' . $meal->getPlaceId()) ?>">View Menu</a>
                        <a href="<?php echo url_for('order/' . $meal->getId()) ?>">Order</a>
                    <?php endif; ?>
                </span>
            </div>
        </li>
        <?php $ctr++; ?>
    <?php endforeach; ?>
    </ul>
</div>