<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($menu->getId(), 'menu_edit', $menu) ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_place_id">
  <?php echo $menu->getPlaceId() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($menu->getCreatedAt()) ? format_date($menu->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($menu->getUpdatedAt()) ? format_date($menu->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
