<div class="title">Order</div>
<?php if($sf_user->hasFlash('info')): ?>
    <p class="info"><?php echo $sf_user->getFlash('info') ?></p>
<?php endif; ?>
<form method="post" id="meal-order">
    <ul id="menu-list">
    <?php $ctr = 0 ?>
    <?php foreach($items as $item): ?>
        <li>
            <input type="checkbox" name="item[<?php echo $ctr ?>]" value="<?php echo $item->getId() ?>" />
            <span><?php echo $item->getName() ?></span>
        </li>
    <?php $ctr++ ?>
    <?php endforeach; ?>
    </ul>
    <div class="buttons">
        <input type="submit" value="Place Order" />
    </div>
</form>