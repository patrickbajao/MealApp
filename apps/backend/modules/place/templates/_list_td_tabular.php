<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($place->getId(), 'place_edit', $place) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $place->getName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_description">
  <?php echo $place->getDescription() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_contact">
  <?php echo $place->getContact() ?>
</td>
