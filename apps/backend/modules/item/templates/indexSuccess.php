<?php use_helper('I18N', 'Date') ?>
<?php include_partial('item/assets') ?>
<div class="title"><?php echo __('Item List', array(), 'messages') ?></div>
<div id="sf_admin_container">
    <?php include_partial('item/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('item/list_header', array('pager' => $pager)) ?>
    </div>
    
    <div id="sf_admin_bar">
        <?php include_partial('item/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('item_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('item/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
              <?php include_partial('item/list_batch_actions', array('helper' => $helper)) ?>
              <?php include_partial('item/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('item/list_footer', array('pager' => $pager)) ?>
    </div>
    
    <div id="items-upload">
        <div class="subtitle">Upload Items</div>
        <form action="<?php echo url_for('item/upload') ?>" method="post" enctype="multipart/form-data">
            <div class="field">
                <?php echo $form['place_id']->renderLabel() ?>
                <?php echo $form['place_id']->render() ?>
            </div>
            <div class="field">
                <?php echo $form['items']->renderLabel() ?>
                <?php echo $form['items']->render() ?>
                <?php echo $form['items']->renderHelp() ?>
            </div>
            <?php echo $form['_csrf_token']->render() ?>
            <input type="submit" value="Upload" />
        </form>
    </div>
</div>
