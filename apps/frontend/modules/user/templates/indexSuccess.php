<div class="title">Home</div>
<h1 id="welcome">Welcome <?php echo $username?>!</h1>
<div class="subtitle">Meals!</div>
<div id="meal-list">
<?php include_partial('meal/list', array('meals' => $meals, 'user' => $sf_user->getGuardUser())) ?>
</div>