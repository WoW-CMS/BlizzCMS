<section class="uk-section uk-section-xsmall bc-primary-section" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-grid-small" uk-grid>
      <div class="uk-width-1-4@s"></div>
      <div class="uk-width-1-2@s">
        <h1 class="uk-h3 uk-text-uppercase uk-text-bold uk-margin-medium-top uk-margin-small-bottom"><?= lang('reset_password') ?></h1>
        <?= $template['partials']['alerts'] ?>
        <?= form_open(current_url()) ?>
          <div class="uk-grid-small uk-margin-small" uk-grid>
            <div class="uk-width-1-1">
              <label class="uk-form-label"><?= lang('token') ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fa-solid fa-key"></i></span>
                  <input class="uk-input" type="text" name="token" value="<?= set_value('token', $token) ?>" placeholder="<?= lang('token') ?>" autocomplete="off">
                </div>
              </div>
              <?= form_error('token', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-1">
              <label class="uk-form-label"><?= lang('new_password') ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fa-solid fa-lock"></i></span>
                  <input class="uk-input" type="password" name="new_password" placeholder="<?= lang('new_password') ?>" autocomplete="new-password">
                </div>
              </div>
              <?= form_error('new_password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
          </div>
          <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-top" type="submit"><?= lang('reset') ?></button>
        <?= form_close() ?>
      </div>
      <div class="uk-width-1-4@s"></div>
    </div>
  </div>
</section>
