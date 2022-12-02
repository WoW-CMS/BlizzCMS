<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/bans') ?>"><?= lang('bans') ?></a></li>
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
              <label class="uk-form-label"><?= lang('username') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="username" value="<?= set_value('username', $user) ?>" placeholder="<?= lang('username') ?>" autocomplete="off">
              </div>
              <?= form_error('username', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-1">
              <label class="uk-form-label"><?= lang('reason') ?></label>
              <div class="uk-form-controls">
                <textarea class="uk-textarea" name="reason" rows="4" autocomplete="off"><?= set_value('reason') ?></textarea>
              </div>
              <?= form_error('reason', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-1">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-width-auto@s">
                  <label class="uk-form-label"><?= lang('type') ?></label>
                  <div class="uk-radio-button-group bc-show-group">
                    <div class="uk-radio-container">
                      <input class="uk-radio-button" type="radio" name="type" value="0" <?= set_radio('type', '0') ?>>
                      <div class="uk-label-container">
                        <div class="uk-label-dot"></div>
                        <label><?= lang('permanent') ?></label>
                      </div>
                    </div>
                    <div class="uk-radio-container">
                      <input class="uk-radio-button" type="radio" name="type" value="1" <?= set_radio('type', '1') ?>>
                      <div class="uk-label-container">
                        <div class="uk-label-dot"></div>
                        <label><?= lang('temporary') ?></label>
                      </div>
                    </div>
                  </div>
                  <?= form_error('type', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-2-5@s">
                  <div id="type_1" hidden>
                    <label class="uk-form-label"><?= lang('timespan') ?></label>
                    <div class="uk-grid-small" uk-grid>
                      <div class="uk-width-1-3">
                        <div class="uk-form-controls">
                          <div class="uk-inline uk-width-1-1">
                            <span class="uk-form-icon"><i class="fa-solid fa-stopwatch"></i></span>
                            <input class="uk-input" type="text" name="value" value="<?= set_value('value') ?>" autocomplete="off">
                          </div>
                        </div>
                      </div>
                      <div class="uk-width-expand">
                        <div class="uk-form-controls">
                          <select class="uk-select tail-single" id="select_option" name="value_option" autocomplete="off" data-placeholder="<?= lang('select_option') ?>">
                            <option value="D" <?= set_select('value_option', 'D') ?>><?= lang('days') ?></option>
                            <option value="M" <?= set_select('value_option', 'M') ?>><?= lang('months') ?></option>
                            <option value="Y" <?= set_select('value_option', 'Y') ?>><?= lang('years') ?></option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?= form_error('value', '<span class="uk-display-block uk-text-small uk-text-danger">', '</span>') ?>
                    <?= form_error('value_option', '<span class="uk-display-block uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
                <div class="uk-width-expand@s"></div>
              </div>
            </div>
          </div>
          <div class="uk-tile uk-tile-muted uk-padding-small">
            <h5 class="uk-h6 uk-text-bold uk-text-uppercase uk-margin-remove"><i class="fa-regular fa-circle-question"></i> <?= lang('types') ?>:</h5>
            <ul class="uk-list uk-list-square uk-list-collapse uk-text-small uk-margin-remove">
              <li><span class="uk-text-secondary uk-text-bold"><?= lang('permanent') ?>:</span> <?= lang('permanent_ban_note') ?></li>
              <li><span class="uk-text-secondary uk-text-bold"><?= lang('temporary') ?>:</span> <?= lang('temporary_ban_note') ?></li>
            </ul>
          </div>
        </div>
      </div>
      <button class="uk-button uk-button-primary" type="submit"><?= lang('add') ?></button>
    <?= form_close() ?>
  </div>
</section>
