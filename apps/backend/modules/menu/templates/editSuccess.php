<?php use_helper('I18N', 'Date') ?>
<?php include_partial('menu/assets') ?>
<div class="title"><?php echo __('Edit Menu', array(), 'messages') ?></div>
<div id="sf_admin_container">
    <?php include_partial('menu/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('menu/form_header', array('menu' => $menu, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('menu/form', array('menu' => $menu, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('menu/form_footer', array('menu' => $menu, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
</div>
