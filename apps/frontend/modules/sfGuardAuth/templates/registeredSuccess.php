<div class="flash">
<?php if($sf_user->hasFlash('info')): ?>
    <?php echo $sf_user->getFlash('info') ?></p>
<?php endif; ?>
<span class="link"><?php echo link_to('Click to continue to your homepage', '@homepage') ?></div>
</div>