<?php if($sf_user->hasFlash('info')): ?>
    <p class="info"><?php echo $sf_user->getFlash('info') ?></p>
<?php endif; ?>
<?php if($sf_user->hasFlash('error')): ?>
    <p class="error"><?php echo $sf_user->getFlash('error') ?></p>
<?php endif; ?>