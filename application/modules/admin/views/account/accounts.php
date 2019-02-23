      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-list-ul"></i></span><?= $this->lang->line('admin_users_list'); ?></h4>
                </div>
                <div class="uk-width-expand"></div>
              </div>
            </div>
            <div class="uk-card-body">
              <div class="uk-overflow-auto uk-margin-small">
                <table class="uk-table uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-table-expand"><?= $this->lang->line('form_username'); ?></th>
                      <th class="uk-width-small uk-text-center"><?= $this->lang->line('form_email'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($this->admin_model->getAdminAccountsList()->result() as $accs): ?>
                    <tr>
                      <td class="uk-table-link"><a href="<?= base_url('admin/manageaccount/'.$accs->id); ?>" class="uk-link-reset"><?= $accs->username ?></a></td>
                      <td class="uk-table-link"><a href="<?= base_url('admin/manageaccount/'.$accs->id); ?>" class="uk-link-reset"><?= $accs->email ?></a></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
