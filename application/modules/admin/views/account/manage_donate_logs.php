    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-donate"></i> <?= $this->lang->line('placeholder_donation_logs'); ?> - <?= $this->wowauth->getUsernameID($idlink); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="" class="uk-icon-button"><i class="fas fa-info"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-overflow-auto">
            <table class="uk-table uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-width-small"><?= $this->lang->line('table_header_payment_id'); ?></th>
                  <th class="uk-width-medium"><?= $this->lang->line('table_header_hash'); ?></th>
                  <th class="uk-width-small"><?= $this->lang->line('table_header_total'); ?></th>
                  <th class="uk-width-small"><?= $this->lang->line('table_header_status'); ?></th>
                  <th class="uk-width-small"><?= $this->lang->line('table_header_create_time'); ?></th>
                  <th class="uk-width-small"><?= $this->lang->line('table_header_points'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($this->admin_model->getUserHistoryDonate($idlink)->result() as $donateInfo): ?>
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
