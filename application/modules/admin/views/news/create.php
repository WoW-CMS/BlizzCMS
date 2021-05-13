    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('news'); ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin'); ?>"><?= lang('dashboard'); ?></a></li>
              <li><span><?= lang('news'); ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('admin/news'); ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <?= $template['partials']['alerts']; ?>
        <?= form_open_multipart(current_url()); ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h4 class="uk-h4"><i class="fas fa-pen"></i> <?= lang('create_news'); ?></h4>
          </div>
          <div class="uk-card-body">
            <div class="uk-margin-small">
              <label class="uk-form-label"><?= lang('title'); ?></label>
              <div class="uk-form-controls">
                <input class="uk-input uk-width-1-1" type="text" name="title" value="<?= set_value('title'); ?>" placeholder="<?= lang('title'); ?>">
              </div>
              <?= form_error('title', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
            </div>
            <div class="uk-margin-small">
              <label class="uk-form-label"><?= lang('description'); ?></label>
              <div class="uk-form-controls">
                <textarea class="uk-textarea tinyeditor" name="description" rows="12"><?= set_value('description'); ?></textarea>
              </div>
              <?= form_error('description', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
            </div>
            <div class="uk-margin-small">
              <label class="uk-form-label"><?= lang('upload_image'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <div uk-form-custom="target: true">
                    <input type="file" name="image">
                    <input class="uk-input uk-form-width-medium" type="text" disabled>
                    <button class="uk-button uk-button-primary" type="button" tabindex="-1"><i class="fas fa-file-upload"></i> <?= lang('select'); ?></button>
                  </div>
                </div>
              </div>
              <?= form_error('image', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
            </div>
            <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom uk-heading-line"><span><?= lang('optional_settings'); ?></span></h5>
            <div class="uk-grid uk-grid-small uk-flex uk-flex-middle uk-margin-small" data-uk-grid>
              <div class="uk-width-expand">
                <label class="uk-form-label"><i class="fas fa-toggle-off"></i> <?= lang('enable_news_comments'); ?></label>
                <?= form_error('comments', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
              </div>
              <div class="uk-width-auto">
                <label class="uk-switch">
                  <input type="checkbox" name="comments" value="1" <?= set_checkbox('comments', '1'); ?>>
                  <div class="uk-switch-slider"></div>
                </label>
              </div>
            </div>
          </div>
        </div>
        <button class="uk-button uk-button-primary uk-margin-small" type="submit"><i class="fas fa-plus"></i> <?= lang('create'); ?></button>
        <?= form_close(); ?>
      </div>
    </section>