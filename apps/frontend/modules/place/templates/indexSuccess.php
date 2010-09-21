<?php use_helper('Meal') ?>
<div class="title">Places</div>
<div id="place-list">
    <ul>
    <?php foreach($places as $place): ?>
        <li class="place">
            <span class="counter"><?php echo $place->getId() ?></span>
            <div class="place-info">
                <dl>
                    <dt>Place: </dt>
                        <dd><?php echo $place->getName() ?></dd>
                    <dt>Contact: </dt>
                        <dd><?php echo place_contact($place) ?></dd>
                </dl>
                <span class="links"><?php echo link_to('View Menu', 'place/' . $place->getId()) ?></span>
            </div>            
        </li>
    <?php endforeach; ?>
    </ul>
</div>