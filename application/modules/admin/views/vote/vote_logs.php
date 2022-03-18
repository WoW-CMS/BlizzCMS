<div class="uk-container uk-margin">
    <div class="uk-card uk-card-default uk-card-body">
        <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
            <thead>
                <tr>
                    <th>ID Account</th>
                    <th>ID Vote</th>
                    <th>Points</th>
                    <th>Last Time</th>
                    <th>Expired At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($votes as $vote): ?>
                    <tr>
                        <td><?= $vote->idaccount; ?></td>
                        <td><?= $vote->idvote; ?></td>
                        <td><?= $vote->points; ?></td>
                        <td><?= gmdate("m/d/Y H:i",$vote->lasttime); ?></td>
                        <td><?= gmdate("m/d/Y H:i",$vote->expired_at); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
