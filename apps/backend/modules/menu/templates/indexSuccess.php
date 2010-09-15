<?php use_helper('I18N', 'Date') ?>
<?php include_partial('menu/assets') ?>
<div class="title"><?php echo __('Menu List', array(), 'messages') ?></div>
<div id="sf_admin_container">
    <?php include_partial('menu/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('menu/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar">
        <?php include_partial('menu/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('menu_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('menu/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
              <?php include_partial('menu/list_batch_actions', array('helper' => $helper)) ?>
              <?php include_partial('menu/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('menu/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
