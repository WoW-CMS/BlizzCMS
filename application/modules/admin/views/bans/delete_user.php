<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/bans') ?>"><?= lang('bans') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('delete_ban') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <?= form_open(current_url()) ?>
      <div class="uk-card uk-card-default uk-margin">
        <div class="uk-card-body">
          <div class="uk-margin-small-bottom">
            <label class="uk-form-label"><?= lang('username') ?></label>
            <div class="uk-form-controls">
              <input class="uk-input" type="text" name="username" value="<?= set_value('username', $user) ?>" placeholder="<?= lang('username') ?>" autocomplete="off">
            </div>
            <?= form_error('username', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
          </div>
        </div>
      </div>
      <button class="uk-button uk-button-primary" type="submit"><?= lang('delete') ?></button>
    <?= form_close() ?>
  </div>
</section>
