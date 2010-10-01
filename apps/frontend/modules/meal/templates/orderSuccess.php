<?php use_helper('Meal') ?>
<div class="title">Order</div>
<?php if($sf_user->hasFlash('info')): ?>
    <p class="info"><?php echo $sf_user->getFlash('info') ?></p>
<?php endif; ?>
<form method="post" id="meal-order">
    <?php echo order_menu($menu, $order) ?>
    <div class="buttons">
        <input type="submit" value="Place Order" />
    </div>
</form>