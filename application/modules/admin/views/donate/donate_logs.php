<div class="uk-container uk-margin">
    <div class="uk-card uk-card-default uk-card-body">
        <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Payment ID</th>
                    <th>Hash</th>
                    <th>Total</th>
                    <th>Points</th>
                    <th>Create Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($donations as $donation): ?>
                    <tr>
                        <td><?= $donation->id; ?></td>
                        <td><?= $donation->user_id; ?></td>
                        <td><?= $donation->payment_id; ?></td>
                        <td><?= $donation->hash; ?></td>
                        <td><?= $donation->total; ?></td>
                        <td><?= $donation->points; ?></td>
                        <td><?= $donation->create_time; ?></td>
                        <td><?= $donation->status; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
