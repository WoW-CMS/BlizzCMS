    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('donation_logs'); ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin'); ?>"><?= lang('admin_nav_dashboard'); ?></a></li>
              <li><span><?= lang('admin_nav_accounts'); ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto"></div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h4 class="uk-h4"></h4>
          </div>
          <div class="uk-card-body uk-padding-remove uk-overflow-auto">
            <table class="uk-table uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-width-small"><?= lang('payment_id'); ?></th>
                  <th class="uk-width-medium"><?= lang('hash'); ?></th>
                  <th class="uk-width-small"><?= lang('total'); ?></th>
                  <th class="uk-width-small"><?= lang('status'); ?></th>
                  <th class="uk-width-small"><?= lang('date'); ?></th>
                  <th class="uk-width-small"><?= lang('points'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($this->admin_model->getUserHistoryDonate($id) as $donateInfo): ?>
                <tr>
                  <td><?= $donateInfo->payment_id ?></td>
                  <td><?= $donateInfo->hash ?></td>
                  <td><?= $donateInfo->total ?></td>
                  <td><?= $this->admin_model->getDonateStatus($donateInfo->status); ?></td>
                  <td><?= $donateInfo->create_time ?></td>
                  <td><?= $donateInfo->points ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
