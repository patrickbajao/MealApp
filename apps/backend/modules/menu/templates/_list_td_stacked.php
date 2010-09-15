<td colspan="4">
  <?php echo __('%%id%% - %%place_id%% - %%created_at%% - %%updated_at%%', array('%%id%%' => link_to($menu->getId(), 'menu_edit', $menu), '%%place_id%%' => $menu->getPlaceId(), '%%created_at%%' => false !== strtotime($menu->getCreatedAt()) ? format_date($menu->getCreatedAt(), "f") : '&nbsp;', '%%updated_at%%' => false !== strtotime($menu->getUpdatedAt()) ? format_date($menu->getUpdatedAt(), "f") : '&nbsp;'), 'messages') ?>
</td>
