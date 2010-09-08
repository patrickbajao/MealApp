<?php if($sf_user->hasFlash('info')): ?>
    <p class="info"><?php echo $sf_user->getFlash('info') ?></p>
<?php endif; ?>