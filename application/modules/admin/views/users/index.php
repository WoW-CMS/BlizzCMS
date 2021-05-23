    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-expand@s">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('all_users') ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
              <li><span><?= lang('all_users') ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto@s"></div>
        </div>
        <?= $template['partials']['alerts'] ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
              <div class="uk-width-expand@s uk-visible@s">
                <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-list-ul"></i> <?= lang('all_users') ?></h5>
              </div>
              <div class="uk-width-auto@s">
                <?= form_open(site_url('admin/users'), ['method' => 'get']) ?>
                <div class="uk-grid-small" data-uk-grid>
                  <div class="uk-width-expand">
                    <div class="uk-inline uk-width-1-1">
                      <div class="uk-form-controls">
                        <span class="uk-form-icon"><i class="fas fa-search"></i></span>
                        <input class="uk-input uk-form-small" type="text" name="search" value="<?= $search ?>" placeholder="<?= lang('search') ?>">
                      </div>
                    </div>
                  </div>
                  <div class="uk-width-auto">
                    <button class="uk-button uk-button-primary uk-button-small" type="submit"><i class="fas fa-search"></i></button>
                  </div>
                </div>
                <?= form_close() ?>
              </div>
            </div>
          </div>
          <div class="uk-card-body uk-padding-remove">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-table-expand"><?= lang('username') ?></th>
                  <th class="uk-width-medium uk-visible@s"><?= lang('email') ?></th>
                  <th class="uk-width-medium uk-visible@s"><?= lang('date') ?></th>
                  <th class="uk-width-small"><?= lang('actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                  <td>
                    <img class="uk-preserve-width uk-border-circle" src="<?= $template['uploads'].'avatars/'.$this->website->user_avatar($user->id) ?>" width="36" height="36" alt="Avatar">
                    <span class="uk-text-middle"><?= $user->username ?></span>
                  </td>
                  <td class="uk-visible@s"><?= $user->email ?></td>
                  <td class="uk-visible@s"><?= date('Y-m-d H:i', $user->joined_at) ?></td>
                  <td>
                    <div class="uk-button-group">
                      <a href="<?= site_url('admin/users/view/'.$user->id) ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-eye"></i> <?= lang('view') ?></a>
                      <div class="uk-inline">
                        <button class="uk-button uk-button-primary uk-button-small" type="button"><i class="fas fa-ellipsis-v"></i></button>
                        <div uk-dropdown="mode: click;boundary: ! .uk-container;">
                          <ul class="uk-nav uk-dropdown-nav">
                            <li><a href="<?= site_url('admin/users/logs/'.$user->id) ?>"><i class="fas fa-list"></i> <?= lang('logs') ?></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
        <?= $links ?>
      </div>
    </section>
