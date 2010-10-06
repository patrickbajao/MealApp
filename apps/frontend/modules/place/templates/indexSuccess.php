<?php use_helper('Meal') ?>
<div class="title">Places</div>
<div id="place-list">
    <?php include_partial('place/list', array('places' => $pager->getResults())) ?>
</div>
<?php if ($pager->haveToPaginate()): ?>
<div class="pagination">
    <?php echo link_to('<span class="first-page">&laquo;First</span>', '@places?page=1', array('class' => 'first-page')) ?>
    <?php echo link_to('<span class="prev-page">&lsaquo;Previous</span>', '@places?page=' . $pager->getPreviousPage(), array('class' => 'prev-page')) ?>
    <?php foreach ($pager->getLinks() as $page): ?>
        <?php if ($page == $pager->getPage()): ?>
            <span class="current-page"><?php echo $page ?></span>
        <?php else: ?>
            <?php echo link_to('<span class="page">' . $page . '</span>', '@places?page=' . $page, array('class' => 'page')) ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php echo link_to('<span class="next-page">Next&rsaquo;</span>', '@places?page=' . $pager->getNextPage(), array('class' => 'next-page')) ?>
    <?php echo link_to('<span class="last-page">Last&raquo;</span>', '@places?page=' . $pager->getLastPage(), array('class' => 'last-page')) ?>
</div>
<?php endif; ?>