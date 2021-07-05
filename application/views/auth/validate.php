    <section class="uk-section uk-section-xsmall header-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-1-5@s"></div>
          <div class="uk-width-3-5@s">
            <h3 class="uk-h3 uk-text-uppercase uk-text-bold  uk-margin-medium-top uk-margin-small-bottom"><?= lang('validate_your_registration') ?></h3>
            <?= form_open(current_url()) ?>
            <?= $template['partials']['alerts'] ?>
            <div class="uk-margin uk-light">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('nickname') ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-user"></i></span>
                      <input class="uk-input uk-disabled" type="text" value="<?= $user->nickname ?>" placeholder="<?= lang('nickname') ?>">
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('username') ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-user"></i></span>
                      <input class="uk-input uk-disabled" type="text" value="<?= $user->username ?>" placeholder="<?= lang('username') ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin uk-light">
              <label class="uk-form-label"><?= lang('email') ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fas fa-envelope"></i></span>
                  <input class="uk-input uk-disabled" type="email" value="<?= $user->email ?>" placeholder="<?= lang('email') ?>">
                </div>
              </div>
            </div>
            <div class="uk-margin uk-light">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('password') ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-lock"></i></span>
                      <input class="uk-input" type="password" name="password" placeholder="<?= lang('password') ?>">
                    </div>
                  </div>
                  <?= form_error('password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('confirm_password') ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-lock"></i></span>
                      <input class="uk-input" type="password" name="confirm_password" placeholder="<?= lang('confirm_password') ?>">
                    </div>
                  </div>
                  <?= form_error('confirm_password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small" type="submit"><i class="fas fa-user-plus"></i> <?= lang('register') ?></button>
            <?= form_close() ?>
          </div>
          <div class="uk-width-1-5@s"></div>
        </div>
      </div>
    </section>