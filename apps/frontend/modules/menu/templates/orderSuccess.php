<?php if($sf_user->hasFlash('info')): ?>
    <p class="info"><?php echo $sf_user->getFlash('info') ?></p>
<?php endif; ?>
<div id="menu">
<form action="" method="post">
    <ul id="menu-list">
        <li>
            <input type="checkbox" name="item[1]" value="1" />
            <span>Yum</span>
        </li>
    </ul>
    <input type="submit" value="Place Order" />
</form>
</div>