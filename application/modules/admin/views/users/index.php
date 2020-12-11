    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('admin_nav_accounts'); ?></h4>
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
          <div class="uk-card-body uk-padding-remove">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-table-expand"><?= lang('username'); ?></th>
                  <th class="uk-width-medium"><?= lang('email'); ?></th>
                  <th class="uk-width-small"><?= lang('date'); ?></th>
                  <th class="uk-width-small"><?= lang('actions'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                  <td>
                    <img class="uk-preserve-width uk-border-circle" src="<?= $template['uploads'].'avatars/'.$this->website->user_avatar($user->id); ?>" width="36" height="36" alt="Avatar">
                    <span class="uk-text-middle"><?= $user->username; ?></span>
                  </td>
                  <td><?= $user->email; ?></td>
                  <td><?= date('Y-m-d', $user->joined_at); ?></td>
                  <td>
                    <div class="uk-button-group">
                      <a href="<?= site_url('admin/users/view/'.$user->id); ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-user-edit"></i> View</a>
                      <div class="uk-inline">
                        <button class="uk-button uk-button-primary uk-button-small" type="button"><i class="fas fa-ellipsis-v"></i></button>
                        <div uk-dropdown="mode: click;boundary: ! .uk-container;">
                          <ul class="uk-nav uk-dropdown-nav">
                            <li><a href="<?= site_url('admin/users/logs/'.$user->id); ?>"><i class="fas fa-donate"></i> Logs</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <?= $links; ?>
      </div>
    </section>
