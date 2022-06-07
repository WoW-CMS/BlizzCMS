<div class="uk-container uk-margin">
    <div class="uk-card uk-card-default uk-card-body">
        <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
            <thead>
                <tr>
                    <th>ID Purchase</th>
                    <th>ID Account</th>
                    <th>ID Char</th>
                    <th>Item</th>
					<th>Price DP</th>
                    <th>Price VP</th>
					<th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stores as $stores): ?>
                    <tr>
                        <td><?= $stores->id; ?></td>
                        <td><?= $stores->accountid; ?></td>
                        <td><?= $stores->charid; ?></td>
                        <td><?= $stores->item_name; ?></td>
						<td><?= $stores->dp; ?></td>
						<td><?= $stores->vp; ?></td>
                        <td><?= $stores->date; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
