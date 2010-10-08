<?php use_helper('Meal') ?>
<div class="title">Suggest <?php echo suggestion_type($type) ?></div>
<?php include_partial('meal/flashes', array('sf_user' => $sf_user)) ?>
<form method="post" id="suggest" action="<?php echo url_for('@suggest?type=' . $type . '&place_id=' . $place_id) ?>">
    <?php echo $form['place_id']->render() ?>
    <div>
        <span class="required">*</span>
        <?php echo $form['name']->renderLabel() ?>
        <?php echo $form['name']->render() ?>
        <?php echo $form['name']->renderError() ?>
    </div>
    <div>
        <?php echo $form['description']->renderLabel() ?>
        <?php echo $form['description']->render() ?>
    </div>
    <div>
        <?php echo suggestion_fields($type, $form) ?>
    </div>
    <?php echo $form['_csrf_token']->render() ?>
    <div class="buttons">
        <input type="submit" value="Suggest" />&nbsp;<?php echo link_to('<span>Cancel</span>', $from . '/', array('class' => 'cancel')) ?>
    </div>
    <div class="clear"></div>
</form>