<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Contact</th>
            <th class="actions">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($places as $place): ?>
        <tr>
            <td><?php echo $place->getName() ?></td>
            <td><?php echo place_description($place) ?></td>
            <td><?php echo place_contact($place) ?></td>
            <td class="actions"><?php echo link_to('View Menu', 'place/' . $place->getId()) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>