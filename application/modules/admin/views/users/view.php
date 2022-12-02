<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/users') ?>"><?= lang('users') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('user') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <div class="uk-margin" uk-grid>
      <div class="uk-width-1-3@s uk-width-1-4@m">
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-flex uk-flex-center uk-margin-small-bottom">
            <img class="uk-border-circle uk-box-shadow-medium" src="<?= user_avatar($user->id) ?>" width="128" height="128" alt="<?= lang('avatar') ?>">
          </div>
          <div class="uk-text-center uk-margin-small-top">
            <h4 class="uk-h4 uk-margin-remove"><?= $user->username ?></h4>
            <p class="uk-text-small uk-margin-remove"><?= lang('registered_in') ?> <?= format_date($user->created_at, 'M j, Y') ?></p>
          </div>
        </div>
        <?php if ($is_banned): ?>
        <div class="uk-alert-danger" uk-alert>
          <h6 class="uk-h6 uk-text-bold uk-text-uppercase uk-text-center uk-margin-remove"><i class="fa-solid fa-ban"></i> <?= lang('banned_user') ?></h6>
        </div>
        <?php endif ?>
        <div class="uk-card uk-card-default uk-margin">
          <ul class="uk-nav-default" uk-nav>
            <li class="uk-active"><a href="<?= site_url('admin/users/view/'.$user->id) ?>"><?= lang('user') ?></a></li>
            <li><a href="<?= site_url('admin/users/view/'.$user->id.'/characters') ?>"><?= lang('characters') ?></a></li>
            <li><a href="<?= site_url('admin/users/view/'.$user->id.'/logs') ?>"><?= lang('logs') ?></a></li>
          </ul>
        </div>
      </div>
      <div class="uk-width-expand@s">
        <?= $template['partials']['alerts'] ?>
        <?= form_open(site_url('admin/users/update/' . $user->id)) ?>
          <div class="uk-card uk-card-default uk-margin-bottom">
            <div class="uk-grid-small uk-grid-divider uk-child-width-1-1" uk-grid>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('username') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('current_account_username') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input uk-disabled" type="text" value="<?= $user->username ?>" placeholder="<?= lang('username') ?>" autocomplete="off" disabled>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('nickname') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('current_account_nickname') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="nickname" value="<?= $user->nickname ?>" placeholder="<?= lang('nickname') ?>" autocomplete="off">
                    </div>
                    <?= form_error('nickname', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('email') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('current_account_email') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="email" value="<?= $user->email ?>" placeholder="<?= lang('email') ?>" autocomplete="off">
                    </div>
                    <?= form_error('email', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <?php if (! $is_restricted): ?>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('role') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('current_account_role') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <select class="uk-select tail-single" id="select_role" name="role" autocomplete="off" data-placeholder="<?= lang('role') ?>">
                        <?php foreach ($roles as $role): ?>
                        <option value="<?= $role->id ?>" <?= set_select('role', $role->id, $role->id === $user->role) ?>><?= html_escape($role->name) ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <?= form_error('role', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <?php endif ?>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('donation_points') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('current_account_dp') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="dp" value="<?= $user->dp ?>" placeholder="<?= lang('donation_points') ?>" autocomplete="off">
                    </div>
                    <?= form_error('dp', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('voting_points') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('current_account_vp') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="vp" value="<?= $user->vp ?>" placeholder="<?= lang('voting_points') ?>" autocomplete="off">
                    </div>
                    <?= form_error('vp', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button class="uk-button uk-button-primary" type="submit"><?= lang('update') ?></button>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</section>
