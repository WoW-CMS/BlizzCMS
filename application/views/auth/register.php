<section class="uk-section uk-section-xsmall bc-primary-section" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-grid-small" uk-grid>
      <div class="uk-width-1-4@s"></div>
      <div class="uk-width-1-2@s">
        <h1 class="uk-h3 uk-text-uppercase uk-text-bold uk-margin-medium-top uk-margin-small-bottom"><?= lang('register') ?></h1>
        <?= $template['partials']['alerts'] ?>
        <?= form_open(current_url()) ?>
          <div class="uk-grid-small uk-margin-small" uk-grid>
            <div class="uk-width-1-2@s">
              <label class="uk-form-label"><?= lang('nickname') ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fa-solid fa-user"></i></span>
                  <input class="uk-input" type="text" name="nickname" value="<?= set_value('nickname') ?>" placeholder="<?= lang('nickname') ?>" autocomplete="off">
                </div>
              </div>
              <?= form_error('nickname', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-2@s">
              <label class="uk-form-label"><?= lang('username') ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fa-solid fa-user"></i></span>
                  <input class="uk-input" type="text" name="username" value="<?= set_value('username') ?>" placeholder="<?= lang('username') ?>" autocomplete="off">
                </div>
              </div>
              <?= form_error('username', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-1">
              <label class="uk-form-label"><?= lang('email') ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fa-solid fa-envelope"></i></span>
                  <input class="uk-input" type="text" name="email" value="<?= set_value('email') ?>" placeholder="<?= lang('email') ?>" autocomplete="off">
                </div>
              </div>
              <?= form_error('email', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-2@s">
              <label class="uk-form-label"><?= lang('password') ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fa-solid fa-lock"></i></span>
                  <input class="uk-input" type="password" name="password" placeholder="<?= lang('password') ?>" autocomplete="new-password">
                </div>
              </div>
              <?= form_error('password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-2@s">
              <label class="uk-form-label"><?= lang('confirm_password') ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fa-solid fa-lock"></i></span>
                  <input class="uk-input" type="password" name="confirm_password" placeholder="<?= lang('confirm_password') ?>" autocomplete="new-password">
                </div>
              </div>
              <?= form_error('confirm_password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-1">
              <label class="uk-form-label">
                <input class="uk-checkbox" type="checkbox" name="terms" value="agree" <?= set_checkbox('terms', 'agree') ?>> <?= lang('read_and_agree') ?> <a target="_blank" href="<?= site_url('page/terms') ?>"><?= lang('terms_service') ?></a> <?= lang('and') ?> <a target="_blank" href="<?= site_url('page/privacy') ?>"><?= lang('privacy_policy') ?></a>
              </label>
              <?= form_error('terms', '<span class="uk-display-block uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <?php if (config_item('captcha_register_page')): ?>
            <div class="uk-width-1-1">
              <?= captcha_widget() ?>
            </div>
            <?php endif ?>
          </div>
          <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-top" type="submit"><?= lang('register') ?></button>
        <?= form_close() ?>
        <hr class="uk-hr">
        <p class="uk-text-small uk-text-center uk-margin-small"><i class="fa-solid fa-circle-info"></i> <?= lang('already_have_account') ?> <a href="<?= site_url('login') ?>" tabindex="-1"><?= lang('here') ?></a></p>
      </div>
      <div class="uk-width-1-4@s"></div>
    </div>
  </div>
</section>
