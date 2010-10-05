<?php use_helper('Meal') ?>
<div class="title">Meal Order</div>
<?php include_partial('meal/flashes', array('sf_user' => $sf_user)) ?>
<form method="post" id="meal-order" action="<?php echo url_for('@order?meal_id=' . $meal_id . '&from=' . $from_param) ?>">
    <?php $prev_order = $meal->getPreviousOrder($sf_user->getGuardUser()->getId()) ?>
    <?php if($prev_order->count() > 0): ?>
        <?php echo link_to('<span>Set Order from Previous Meal</span>', '@order?meal_id=' . $meal_id . '&from=' . $from_param . '&prev_meal=true', array('class' => 'prev-order')) ?>
    <?php endif; ?>
    <?php echo order_menu($menu, $order) ?>
    <div class="buttons">
        <input type="submit" value="Place Order" />&nbsp;<?php echo link_to('<span>Cancel</span>', $from, array('class' => 'cancel')) ?>
    </div>
</form>