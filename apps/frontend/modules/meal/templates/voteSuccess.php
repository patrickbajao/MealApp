<?php use_helper('Meal') ?>
<div class="title">Vote</div>
<?php include_partial('meal/flashes', array('sf_user' => $sf_user)) ?>
<form method="post" id="place-vote" action="<?php echo url_for('@vote?meal_id=' . $meal_id . '&from=' . $from_param) ?>">
    <?php echo $form['id']->render() ?>
    <?php echo $form['place_id']->render() ?>
    <?php echo $form['_csrf_token']->render() ?>
    <div class="buttons">
        <input type="submit" value="Place Vote" />&nbsp;<?php echo link_to('<span>Cancel</span>', $from, array('class' => 'cancel')) ?>
    </div>
</form>