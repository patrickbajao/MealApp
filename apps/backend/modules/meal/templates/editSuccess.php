<?php use_helper('I18N', 'Date') ?>
<?php include_partial('meal/assets') ?>
<div class="title"><?php echo __('Edit Meal', array(), 'messages') ?></div>
<div id="sf_admin_container">
    <?php include_partial('meal/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('meal/form_header', array('meal' => $meal, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('meal/form', array('meal' => $meal, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('meal/form_footer', array('meal' => $meal, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
</div>
