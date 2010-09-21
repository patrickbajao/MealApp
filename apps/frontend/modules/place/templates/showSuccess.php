<?php use_helper('Meal') ?>
<div class="title"><?php echo $place->getName() ?></div>
<div id="place-data">
<dl>
    <dt>Description:</dt>
        <dd><?php echo place_description($place) ?></dd>
    <dt>Contact:</dt>
        <dd><?php echo place_contact($place) ?></dd>
</dl>
</div>
<div id="menu">
    <div class="subtitle">Menu</div>
    <ul>
    <?php foreach($place->getItems() as $item): ?>
        <li>
            <span class="item-name"><?php echo $item->getName() ?></span>
            <span class="price"><?php echo $item->getPrice() ?></span>
            <p class="description"><?php echo $item->getDescription() ?></p>
        </li>
    <?php endforeach; ?>
    </ul>
</div>