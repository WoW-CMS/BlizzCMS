    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('banned_users') ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
              <li><span><?= lang('banned_users') ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('admin/users/banned') ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <?= $template['partials']['alerts'] ?>
        <?= form_open(current_url()) ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-pen"></i> <?= lang('add_ban') ?></h5>
          </div>
          <div class="uk-card-body">
            <div class="uk-margin-small-bottom">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('username') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="username" value="<?= set_value('username') ?>" placeholder="<?= lang('username') ?>">
                  </div>
                  <?= form_error('username', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('unban_date') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="date" name="date" value="<?= set_value('date') ?>" placeholder="<?= lang('unban_date') ?>">
                  </div>
                  <?= form_error('date', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <label class="uk-form-label"><?= lang('reason') ?></label>
              <div class="uk-form-controls">
                <textarea class="uk-textarea tinyeditor" name="reason" rows="6"><?= set_value('reason') ?></textarea>
              </div>
              <?= form_error('reason', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
          </div>
        </div>
        <button class="uk-button uk-button-primary uk-margin-small" type="submit"><i class="fas fa-plus"></i> <?= lang('add') ?></button>
        <?= form_close() ?>
      </div>
    </section>