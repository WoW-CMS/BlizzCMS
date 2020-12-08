    <section class="uk-section uk-section-xsmall uk-padding-remove uk-height-small header-section">

    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <li class="uk-active"><a href="<?= base_url('user'); ?>"><i class="fas fa-user-circle"></i> <?= lang('tab_account'); ?></a></li>
              <li class="uk-nav-divider"></li>
              <li><a href="<?= base_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?=lang('navbar_donate_panel'); ?></a></li>
              <li><a href="<?= base_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?=lang('navbar_vote_panel'); ?></a></li>
              <li><a href="<?= base_url('store'); ?>"><i class="fas fa-store"></i> <?=lang('tab_store'); ?></a></li>
              <li class="uk-nav-divider"></li>
              <li><a href="<?= base_url('bugtracker'); ?>"><i class="fas fa-bug"></i> <?=lang('tab_bugtracker'); ?></a></li>
              <li><a href="<?= base_url('changelogs'); ?>"><i class="fas fa-scroll"></i> <?=lang('tab_changelogs'); ?></a></li>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <?= $template['partials']['alerts']; ?>
            <div class="uk-card-default myaccount-card uk-margin-small">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-users"></i> <?= lang('panel_change_nickname'); ?></h5>
              </div>
              <div class="uk-card-body">
                <?= form_open(site_url('user/settings/nickname')) ?>
                <div class="uk-margin uk-light">
                  <label class="uk-form-label"><?= lang('panel_current_nickname'); ?>:</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-user"></i></span>
                      <input class="uk-input uk-disabled" type="text" placeholder="<?= $this->session->userdata('nickname'); ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <label class="uk-form-label"><?= lang('placeholder_new_nickname'); ?>:</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="far fa-user"></i> </span>
                      <input class="uk-input" type="text" name="nickname" placeholder="<?= lang('placeholder_new_nickname'); ?>">
                    </div>
                  </div>
                  <?= form_error('nickname', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-form-controls">
                    <label class="uk-form-label"><?= lang('placeholder_password'); ?>:</label>
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-key"></i></span>
                      <input class="uk-input" type="password" name="password" placeholder="<?= lang('placeholder_password'); ?>">
                    </div>
                  </div>
                  <?= form_error('password', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-margin-top">
                  <button class="uk-button uk-button-default uk-width-1-1" type="submit"><i class="fas fa-sync"></i> <?= lang('button_save_changes'); ?></button>
                </div>
                <?= form_close(); ?>
              </div>
            </div>
            <div class="uk-card-default myaccount-card uk-margin-small">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-envelope"></i> <?= lang('panel_change_email'); ?></h5>
              </div>
              <div class="uk-card-body">
                <?= form_open(site_url('user/settings/email')); ?>
                <div class="uk-margin uk-light">
                  <label class="uk-form-label"><?= lang('panel_current_email'); ?>:</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-envelope"></i></span>
                      <input class="uk-input uk-disabled" type="email" placeholder="<?= $this->session->userdata('email'); ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= lang('panel_replace_email_by'); ?>:</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon"><i class="far fa-envelope"></i></span>
                          <input class="uk-input" type="email" name="new_email" placeholder="<?= lang('placeholder_new_email'); ?>">
                        </div>
                      </div>
                      <?= form_error('new_email', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= lang('placeholder_confirm_email'); ?>:</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon"><i class="far fa-envelope"></i></span>
                          <input class="uk-input" type="email" name="confirm_new_email" placeholder="<?= lang('placeholder_confirm_email'); ?>">
                        </div>
                      </div>
                      <?= form_error('confirm_new_email', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-form-controls">
                    <label class="uk-form-label"><?= lang('placeholder_password'); ?>:</label>
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-key"></i></span>
                      <input class="uk-input" type="password" name="cu_password" placeholder="<?= lang('placeholder_password'); ?>">
                    </div>
                  </div>
                  <?= form_error('cu_password', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-margin-top">
                  <button class="uk-button uk-button-default uk-width-1-1" type="submit"><i class="fas fa-sync"></i> <?= lang('button_save_changes'); ?></button>
                </div>
                <?= form_close(); ?>
              </div>
            </div>
            <div class="uk-card-default myaccount-card uk-margin-small">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-key"></i> <?= lang('panel_change_password'); ?></h5>
              </div>
              <div class="uk-card-body">
                <?= form_open(site_url('user/settings/password')); ?>
                <div class="uk-margin uk-light">
                  <label class="uk-form-label"><?= lang('placeholder_current_password'); ?>:</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-key"></i></span>
                      <input class="uk-input" type="password" name="current_password" placeholder="<?= lang('placeholder_current_password'); ?>">
                    </div>
                  </div>
                  <?= form_error('current_password', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= lang('panel_replace_pass_by'); ?></label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon"><i class="fas fa-unlock"></i></span>
                          <input class="uk-input" type="password" name="new_password" placeholder="<?= lang('placeholder_new_password'); ?>">
                        </div>
                      </div>
                      <?= form_error('new_password', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= lang('placeholder_re_password'); ?></label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon"><i class="fas fa-lock"></i></span>
                          <input class="uk-input" type="password" name="confirm_new_password" placeholder="<?= lang('placeholder_re_password'); ?>">
                        </div>
                      </div>
                      <?= form_error('confirm_new_password', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-top">
                  <button class="uk-button uk-button-default uk-width-1-1" type="submit"><i class="fas fa-sync"></i> <?= lang('button_save_changes'); ?></button>
                </div>
                <?= form_close(); ?>
              </div>
            </div>
            <div class="uk-card-default myaccount-card uk-margin-small">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-id-badge"></i> <?= lang('button_change_avatar'); ?></h5>
              </div>
              <div class="uk-card-body">
                <?= form_open(site_url('user/settings/avatar')); ?>
                <div class="uk-margin uk-light">
                  <div class="uk-form-controls">
                    <div class="uk-grid uk-child-width-auto uk-flex uk-flex-center" data-uk-grid>
                      <?php foreach ($this->base->get_avatars() as $avatar): ?>
                        <div>
                          <img class="uk-border-circle uk-margin-small" src="<?= base_url('assets/images/profiles/'.$avatar->name); ?>" width="60" height="60">
                          <input class="uk-radio uk-display-block uk-margin-auto-left uk-margin-auto-right change_avatar" type="radio" name="avatar" value="<?= $avatar->id ?>" <?php if ($this->website->get_user(null, 'profile') == $avatar->id) echo 'checked'; ?>>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <?= form_error('avatar', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-margin-top">
                  <button class="uk-button uk-button-default uk-width-1-1" type="submit"><i class="fas fa-sync"></i> <?= lang('button_save_changes'); ?></button>
                </div>
                <?= form_close(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>