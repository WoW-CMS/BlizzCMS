<section class="uk-section uk-section-xsmall bc-primary-section" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-grid-small" uk-grid>
      <div class="uk-width-1-4@s"></div>
      <div class="uk-width-1-2@s">
        <h1 class="uk-h3 uk-text-uppercase uk-text-bold uk-margin-medium-top uk-margin-small-bottom"><?= lang('login') ?></h1>
        <?= $template['partials']['alerts'] ?>
        <?= form_open(current_url()) ?>
          <div class="uk-grid-small uk-margin-small" uk-grid>
            <div class="uk-width-1-1">
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
              <label class="uk-form-label"><?= lang('password') ?> <a href="<?= site_url('forgot-password') ?>" class="uk-button uk-button-text uk-float-right" tabindex="-1"><?= lang('forgot_your_password') ?></a></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fa-solid fa-unlock-keyhole"></i></span>
                  <input class="uk-input" type="password" name="password" placeholder="<?= lang('password') ?>" autocomplete="off">
                </div>
              </div>
              <?= form_error('password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-1">
              <label class="uk-form-label">
                <input class="uk-checkbox" type="checkbox" name="remember" value="true" <?= set_checkbox('remember', 'true') ?>> <?= lang('remember') ?>
              </label>
              <?= form_error('remember', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <?php if (config_item('captcha_login_page')): ?>
            <div class="uk-width-1-1">
              <?= captcha_widget() ?>
            </div>
            <?php endif ?>
          </div>
          <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-top" type="submit"><?= lang('login') ?></button>
        <?= form_close() ?>
        <hr class="uk-hr">
        <p class="uk-text-small uk-text-center uk-margin-small"><i class="fa-solid fa-circle-info"></i> <?= lang('dont_have_account') ?> <a href="<?= site_url('register') ?>" tabindex="-1"><?= lang('here') ?></a></p>
      </div>
      <div class="uk-width-1-4@s"></div>
    </div>
  </div>
</section>
