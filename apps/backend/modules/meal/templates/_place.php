<?php $place = $meal->getPlace() ?>
<?php echo (!empty($place)) ? $meal->getPlace()->getName() : '' ; ?>