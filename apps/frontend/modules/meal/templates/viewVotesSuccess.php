<div class="title">Meal No. <?php echo $meal->getId() ?> Votes</div>
<div id="all-votes">
<ul>
<?php foreach($votes as $vote): ?>
    <li>
         <?php echo $vote['place'] ?> Votes: <strong><?php echo $vote['votes'] ?></strong>
    </li>
<?php endforeach; ?>
</ul>
</div>