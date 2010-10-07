<?php use_helper('Meal') ?>
<div class="title"><?php echo $place->getName() ?></div>
<div id="place-data">
<?php $image = $place->getImage() ?>
<?php if(!empty($image)): ?>
    <div class="image"><img src="/uploads/places/thumbnails/<?php echo $image ?>" alt="thumbnail" /></div>
<?php endif; ?>
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
            <?php $item_image = $item->getImage() ?>
            <?php if(!empty($item_image)): ?>
                <span class="item-image"><img src="/uploads/items/thumbnails/<?php echo $item_image ?>" alt="thumbnail" /></span>
            <?php endif; ?>
            <span class="price"><?php echo $item->getPrice() ?></span>
            <dl>
                <dt class="item-name"><?php echo $item->getName() ?></dt>
                    <dd class="description"><?php echo $item->getDescription() ?></dd>
            </dl>
            <span class="clear"></span>
        </li>
    <?php endforeach; ?>
    </ul>
</div>