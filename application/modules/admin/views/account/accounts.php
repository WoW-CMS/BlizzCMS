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
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('placeholder_email'); ?></th>
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_date'); ?></th>
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_actions'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php if(isset($accountsList) && !empty($accountsList)): ?>
                <?php foreach($accountsList as $account): ?>
                <tr>
                  <td>
                    <img class="uk-preserve-width uk-border-rounded" src="<?= base_url('assets/images/profiles/'.$this->wowauth->getNameAvatar($account->profile)); ?>" alt="Avatar" width="36">
                    <span class="uk-text-middle"><?= $account->username ?></span>
                  </td>
                  <td class="uk-text-center"><?= $account->email ?></td>
                  <td class="uk-text-center"><?= date('Y-m-d', $account->joindate); ?></td>
                  <td>
                    <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                      <a href="<?= base_url('admin/account/manage/'.$account->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-user-edit"></i></a>
                      <a href="<?= base_url('admin/account/dlogs/'.$account->id); ?>" class="uk-button uk-button-primary"><i class="fas fa-donate"></i></a>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <div class="uk-card-footer">
            <div class="uk-text-right">
              <?php if (isset($accountsList) && is_array($accountsList)) echo $pagination_links; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
