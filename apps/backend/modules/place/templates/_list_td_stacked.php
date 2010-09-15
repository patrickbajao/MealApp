<td colspan="4">
  <?php echo __('%%id%% - %%name%% - %%description%% - %%contact%%', array('%%id%%' => link_to($place->getId(), 'place_edit', $place), '%%name%%' => $place->getName(), '%%description%%' => $place->getDescription(), '%%contact%%' => $place->getContact()), 'messages') ?>
</td>
