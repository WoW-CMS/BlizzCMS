    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('topsites') ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
              <li><span><?= lang('topsites') ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('vote/admin') ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <?= $template['partials']['alerts'] ?>
        <?= form_open(current_url()) ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-pen"></i> <?= lang('create_topsite') ?></h5>
          </div>
          <div class="uk-card-body">
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('name') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="name" value="<?= set_value('name') ?>" placeholder="<?= lang('name') ?>">
                  </div>
                  <?= form_error('name', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('url') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="url" name="url" value="<?= set_value('url') ?>" placeholder="<?= lang('url') ?>">
                  </div>
                  <?= form_error('url', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('time') ?> <span class="uk-text-bold">(<?= lang('hours') ?>)</span></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="number" name="time" value="<?= set_value('time') ?>" placeholder="Hours">
                  </div>
                  <?= form_error('time', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('points') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="number" name="points" value="<?= set_value('points') ?>" placeholder="<?= lang('points') ?>">
                  </div>
                  <?= form_error('points', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <label class="uk-form-label">URL Image</label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="image" value="<?= set_value('image') ?>" placeholder="http://example.com/image.jpg">
              </div>
              <?= form_error('image', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
          </div>
        </div>
        <button class="uk-button uk-button-primary uk-margin-small" type="submit"><i class="fas fa-plus"></i> <?= lang('create') ?></button>
        <?= form_close() ?>
      </div>
    </section>