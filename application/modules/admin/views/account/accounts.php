    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-users-cog"></i> <?= $this->lang->line('admin_nav_accounts'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="" class="uk-icon-button"><i class="fas fa-info"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-overflow-auto">
            <table class="uk-table uk-table-hover uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-width-small"><?= $this->lang->line('placeholder_username'); ?></th>
                  <th class="uk-width-small"><?= $this->lang->line('placeholder_email'); ?></th>
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_actions'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($this->admin_model->getAdminAccountsList()->result() as $accs): ?>
                <tr>
                  <td>
                    <img class="uk-preserve-width uk-border-rounded" src="https://via.placeholder.com/100/090e40/ffffff" alt="Avatar" width="36">
                    <span class="uk-text-middle"><?= $accs->username ?></span>
                  </td>
                  <td><?= $accs->email ?></td>
                  <td>
                    <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                      <a href="<?= base_url('admin/manageaccount/'.$accs->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-user-edit"></i></a>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="uk-card-footer">
            <ul class="uk-pagination uk-flex-center" uk-margin>
              <li><a href="#"><span uk-pagination-previous></span></a></li>
              <li class="uk-active"><span>1</span></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#"><span uk-pagination-next></span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
