    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('bugtracker') ?></h4>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('bugtracker') ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-arrow-circle-left"></i> <?= lang('back') ?></a>
          </div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <?= $template['partials']['alerts'] ?>
        <?= form_open(current_url()) ?>
        <div class="uk-card uk-card-default uk-margin-small">
          <div class="uk-card-header">
            <div class="uk-grid uk-grid-small uk-flex uk-flex-middle">
              <div class="uk-width-expand">
                <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-bug"></i> <?= lang('create_report') ?></h5>
              </div>
              <div class="uk-width-auto"></div>
            </div>
          </div>
          <div class="uk-card-body">
            <div class="uk-margin-small uk-light">
              <label class="uk-form-label"><?= lang('title') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="title" value="<?= set_value('title') ?>" placeholder="<?= lang('title') ?>">
              </div>
              <?= form_error('title', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-margin-small uk-light">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('realm') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="realm">
                      <option value="" hidden selected><?= lang('select_realm') ?></option>
                      <?php foreach ($realms as $realm): ?>
                      <option value="<?= $realm->id ?>" <?= set_select('realm', $realm->id) ?>><?= $realm->name ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <?= form_error('realm', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('category') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="category">
                      <option value="" hidden selected><?= lang('select_category') ?></option>
                      <?php foreach ($categories as $cat): ?>
                      <option value="<?= $cat->id ?>" <?= set_select('category', $cat->id) ?>><?= $cat->name ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <?= form_error('category', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small-top uk-light">
              <label class="uk-form-label"><?= lang('description') ?></label>
              <div class="uk-form-controls">
                <textarea class="uk-textarea tinyeditor" name="description" rows="12"><?= set_value('description') ?></textarea>
              </div>
              <?= form_error('description', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
          </div>
        </div>
        <button class="uk-button uk-button-default uk-margin-small-top" type="submit"><i class="fas fa-plus"></i> <?= lang('create') ?></button>
        <?= form_close() ?>
      </div>
    </section>