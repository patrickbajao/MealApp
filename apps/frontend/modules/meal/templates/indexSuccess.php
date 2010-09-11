<p class="title">Meals</p>
<div>
    <ul>
    <?php foreach($meals as $meal): ?>
        <li class="">
            <?php $place = (!is_null($meal->getPlace())) ? $meal->getPlace()->getName() : 'No chosen place for this meal yet.' ; ?>
            <span class="place"><?php echo $place ?></span>
            <span class="type"><?php echo $meal->getType() ?></span>
            <?php if(is_null($meal->getPlace())): ?>
                <span class="link"><a href="<?php echo url_for('vote/' . $meal->getId()) ?>">Vote</a></span>
            <?php else: ?>
                <span class="link"><a href="<?php echo url_for('order/' . $meal->getId()) ?>">Order</a></span>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
    </ul>
</div>