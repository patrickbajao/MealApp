<?php use_helper('I18N', 'Date') ?>
<?php include_partial('item/assets') ?>
<div class="title"><?php echo __('Edit Item', array(), 'messages') ?></div>
<div id="sf_admin_container">
    <?php include_partial('item/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('item/form_header', array('item' => $item, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('item/form', array('item' => $item, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('item/form_footer', array('item' => $item, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
</div>
