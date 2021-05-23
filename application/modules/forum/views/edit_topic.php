    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('forum') ?></h4>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('forum/topic/'.$topic->id) ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-arrow-circle-left"></i> <?= lang('back') ?></a>
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
            <h4 class="uk-h4 uk-text-bold uk-margin-remove"><i class="fas fa-pen-square"></i> <?= lang('edit_topic') ?></h4>
          </div>
          <div class="uk-card-body">
            <div class="uk-margin-small uk-light">
              <label class="uk-form-label"><?= lang('title') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="title" value="<?= $topic->title ?>" placeholder="<?= lang('title') ?>">
              </div>
              <?= form_error('title', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-margin-small-top uk-light">
              <label class="uk-form-label"><?= lang('description') ?></label>
              <div class="uk-form-controls">
                <textarea class="uk-textarea tinyeditor" name="description" rows="10"><?= $topic->description ?></textarea>
              </div>
              <?= form_error('description', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
          </div>
        </div>
        <button class="uk-button uk-button-default uk-margin-small-top" type="submit"><i class="fas fa-save"></i> <?= lang('save') ?></button>
        <?= form_close() ?>
      </div>
    </section>