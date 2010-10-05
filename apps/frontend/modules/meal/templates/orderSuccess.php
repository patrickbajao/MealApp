<?php use_helper('Meal') ?>
<div class="title">Meal Order</div>
<?php include_partial('meal/flashes', array('sf_user' => $sf_user)) ?>
<form method="post" id="meal-order" action="<?php echo url_for('@order?meal_id=' . $meal_id . '&from=' . $from) ?>">
    <?php echo order_menu($menu, $order) ?>
    <div class="buttons">
        <input type="submit" value="Place Order" />&nbsp;<?php echo link_to('<span>Cancel</span>', '@' . $from, array('class' => 'cancel')) ?>
    </div>
</form>