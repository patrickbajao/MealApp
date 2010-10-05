<div class="title">Meal No. <?php echo $meal->getId() ?> Votes</div>
<div id="all-votes">
<ul>
<?php foreach($votes['all'] as $vote): ?>
    <li>
         <?php echo $vote['place'] ?> Votes: <strong><?php echo $vote['votes'] ?></strong>
    </li>
<?php endforeach; ?>
</ul>
</div>
<?php if($sf_user->getGuardUser()->getIsSuperAdmin()): ?>
<div id="user-votes">
<div class="subtitle">User Votes</div>
<ul>
<?php foreach($votes['votes'] as $vote): ?>
    <li>
        <span class="user"><strong><?php echo $vote['user']->getProfile()->getFirstName() ?> <?php echo $vote['user']->getProfile()->getLastName() ?></strong> voted for: <strong><?php echo $vote['place'] ?></strong></span>
    </li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>