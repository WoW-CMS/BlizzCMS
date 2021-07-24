    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('user_panel') ?></h4>
          </div>
          <div class="uk-width-auto"></div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="far fa-list-alt"></i> <?= lang('menu') ?></h5>
              </div>
              <ul class="uk-nav-default aside-nav uk-nav-parent-icon" uk-nav>
                <li><a href="<?= site_url('user') ?>"><i class="fas fa-user-circle"></i> <?= lang('my_account') ?></a></li>
                <li class="uk-active"><a href="<?= site_url('user/settings') ?>"><i class="fas fa-tools"></i> <?= lang('account_settings') ?></a></li>
                <li><a href="<?= site_url('donate') ?>"><i class="fas fa-hand-holding-usd"></i> <?= lang('donate_panel') ?></a></li>
                <li><a href="<?= site_url('vote') ?>"><i class="fas fa-vote-yea"></i> <?= lang('vote_panel') ?></a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@m">
            <?= $template['partials']['alerts'] ?>
            <?= form_open(site_url('user/settings/nickname')) ?>
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="fas fa-users"></i> <?= lang('change_nickname') ?></h5>
              </div>
              <div class="uk-card-body">
                <div class="uk-margin-small">
                  <label class="uk-form-label"><?= lang('current_nickname') ?>:</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-user"></i></span>
                      <input class="uk-input uk-disabled" type="text" placeholder="<?= $this->session->userdata('nickname') ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label"><?= lang('new_nickname') ?>:</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="far fa-user"></i> </span>
                      <input class="uk-input" type="text" name="nickname" value="<?= set_value('nickname') ?>" placeholder="<?= lang('new_nickname') ?>">
                    </div>
                  </div>
                  <?= form_error('nickname', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-margin-small">
                  <div class="uk-form-controls">
                    <label class="uk-form-label"><?= lang('password') ?>:</label>
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-key"></i></span>
                      <input class="uk-input" type="password" name="password" placeholder="<?= lang('password') ?>">
                    </div>
                  </div>
                  <?= form_error('password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <button class="uk-button uk-button-default uk-margin-small" type="submit"><i class="fas fa-sync"></i> <?= lang('save_changes') ?></button>
            <?= form_close() ?>
            <?= form_open(site_url('user/settings/email')) ?>
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="fas fa-envelope"></i> <?= lang('change_email') ?></h5>
              </div>
              <div class="uk-card-body">
                <div class="uk-margin-small">
                  <label class="uk-form-label"><?= lang('current_email') ?>:</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-envelope"></i></span>
                      <input class="uk-input uk-disabled" type="email" placeholder="<?= $this->session->userdata('email') ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= lang('new_email') ?>:</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon"><i class="far fa-envelope"></i></span>
                          <input class="uk-input" type="email" name="new_email" value="<?= set_value('new_email') ?>" placeholder="<?= lang('new_email') ?>">
                        </div>
                      </div>
                      <?= form_error('new_email', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= lang('confirm_new_email') ?>:</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon"><i class="far fa-envelope"></i></span>
                          <input class="uk-input" type="email" name="confirm_new_email" value="<?= set_value('confirm_new_email') ?>" placeholder="<?= lang('confirm_new_email') ?>">
                        </div>
                      </div>
                      <?= form_error('confirm_new_email', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <div class="uk-form-controls">
                    <label class="uk-form-label"><?= lang('password') ?>:</label>
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-key"></i></span>
                      <input class="uk-input" type="password" name="cu_password" placeholder="<?= lang('password') ?>">
                    </div>
                  </div>
                  <?= form_error('cu_password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <button class="uk-button uk-button-default uk-margin-small" type="submit"><i class="fas fa-sync"></i> <?= lang('save_changes') ?></button>
            <?= form_close() ?>
            <?= form_open(site_url('user/settings/password')) ?>
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="fas fa-key"></i> <?= lang('change_password') ?></h5>
              </div>
              <div class="uk-card-body">
                <div class="uk-margin-small">
                  <label class="uk-form-label"><?= lang('current_password') ?>:</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-key"></i></span>
                      <input class="uk-input" type="password" name="current_password" placeholder="<?= lang('current_password') ?>">
                    </div>
                  </div>
                  <?= form_error('current_password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= lang('new_password') ?></label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon"><i class="fas fa-unlock"></i></span>
                          <input class="uk-input" type="password" name="new_password" placeholder="<?= lang('new_password') ?>">
                        </div>
                      </div>
                      <?= form_error('new_password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= lang('confirm_password') ?></label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon"><i class="fas fa-lock"></i></span>
                          <input class="uk-input" type="password" name="confirm_new_password" placeholder="<?= lang('confirm_password') ?>">
                        </div>
                      </div>
                      <?= form_error('confirm_new_password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <button class="uk-button uk-button-default uk-margin-small" type="submit"><i class="fas fa-sync"></i> <?= lang('save_changes') ?></button>
            <?= form_close() ?>
            <?= form_open(site_url('user/settings/avatar')) ?>
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="fas fa-id-badge"></i> <?= lang('change_avatar') ?></h5>
              </div>
              <div class="uk-card-body">
                <div class="uk-margin-small">
                  <div class="uk-form-controls">
                    <div class="uk-grid uk-child-width-auto uk-flex uk-flex-center" data-uk-grid>
                      <?php foreach ($this->avatars->find_all() as $avatar): ?>
                        <div>
                          <img class="uk-border-circle uk-margin-small" src="<?= $template['uploads'].'avatars/'.$avatar->image ?>" width="60" height="60">
                          <input class="uk-radio uk-display-block uk-margin-auto-left uk-margin-auto-right change_avatar" type="radio" name="avatar" value="<?= $avatar->id ?>" <?php if ($this->cms->user(null, 'avatar') == $avatar->id) echo 'checked' ?>>
                        </div>
                      <?php endforeach ?>
                    </div>
                  </div>
                  <?= form_error('avatar', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <button class="uk-button uk-button-default uk-margin-small" type="submit"><i class="fas fa-sync"></i> <?= lang('save_changes') ?></button>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </section>