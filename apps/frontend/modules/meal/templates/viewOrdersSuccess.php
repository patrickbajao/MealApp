<div class="title">Meal No. <?php echo $meal->getId() ?> Orders: <?php echo $meal->getPlace()->getName() ?></div>
<div id="user-orders">
<div class="subtitle">User Orders</div>
<ul>
<?php foreach($orders['orders'] as $order): ?>
    <li>
        <span class="user"><strong><?php echo $order['user']->getProfile()->getFirstName() ?> <?php echo $order['user']->getProfile()->getLastName() ?></strong> ordered for:</span>
        <ul>
        <?php foreach($order['items'] as $item): ?>
            <li><strong><?php echo $item['count'] ?></strong> <?php echo $item['item']->getName() ?> <?php echo (!empty($item['comments'])) ? ' - <em>' . $item['comments'] . '</em>' : '' ; ?></li>
        <?php endforeach; ?>
        </ul>
    </li>
<?php endforeach; ?>
</ul>
</div>
<div id="all-orders">
<div class="subtitle">All Orders</div>
<ul>
<?php foreach($orders['all'] as $order): ?>
    <li>
        <strong><?php echo $order['count'] ?></strong> <?php echo $order['name'] ?>
    </li>
<?php endforeach; ?>
</ul>
</div>