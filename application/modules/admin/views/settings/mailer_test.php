<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/settings') ?>"><?= lang('settings') ?></a></li>
          <li><a href="<?= site_url('admin/settings/mailer') ?>"><?= lang('mailer') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('verify') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <?= form_open(current_url()) ?>
      <div class="uk-card uk-card-default uk-margin">
        <div class="uk-card-body">
          <div class="uk-grid-small uk-margin-small" uk-grid>
            <div class="uk-width-1-1">
              <label class="uk-form-label"><?= lang('send_to') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="email" value="<?= set_value('email') ?>" placeholder="<?= lang('email') ?>" autocomplete="off">
              </div>
              <?= form_error('email', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-1">
              <label class="uk-form-label"><?= lang('html') ?></label>
              <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                <div class="uk-width-auto">
                  <label class="uk-switch uk-display-block">
                    <input type="checkbox" name="html" value="true" <?= set_checkbox('html', 'true') ?>>
                    <div class="uk-switch-slider"></div>
                  </label>
                </div>
                <div class="uk-width-expand">
                  <p class="uk-text-meta uk-margin-remove"><?= lang('send_email_format') ?></p>
                </div>
              </div>
              <?= form_error('html', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
          </div>
        </div>
      </div>
      <button class="uk-button uk-button-primary" type="submit"><?= lang('send') ?></button>
    <?= form_close() ?>
    <?php if ($this->session->flashdata('debug')): ?>
    <ul uk-accordion>
      <li>
        <a class="uk-accordion-title" href="#"><i class="fa-solid fa-envelope-open-text"></i> <?= lang('debug_result') ?></a>
        <div class="uk-accordion-content">
          <?= $this->session->flashdata('debug') ?>
        </div>
      </li>
    </ul>
    <?php endif ?>
  </div>
</section>
