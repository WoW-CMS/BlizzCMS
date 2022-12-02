<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/bans') ?>"><?= lang('bans') ?></a></li>
          <li><a href="<?= site_url('admin/bans/ips') ?>"><?= lang('banned_ips') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('add_ban') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <?= form_open(current_url()) ?>
      <div class="uk-card uk-card-default uk-margin">
        <div class="uk-card-body">
          <div class="uk-grid-small uk-margin-small" uk-grid>
            <div class="uk-width-1-1">
              <label class="uk-form-label"><?= lang('ip') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="ip" value="<?= set_value('ip') ?>" placeholder="<?= lang('ip') ?>" autocomplete="off">
              </div>
              <?= form_error('ip', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-1">
              <label class="uk-form-label"><?= lang('reason') ?></label>
              <div class="uk-form-controls">
                <textarea class="uk-textarea" name="reason" rows="4" autocomplete="off"><?= set_value('reason') ?></textarea>
              </div>
              <?= form_error('reason', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
          </div>
        </div>
      </div>
      <button class="uk-button uk-button-primary" type="submit"><?= lang('add') ?></button>
    <?= form_close() ?>
  </div>
</section>
