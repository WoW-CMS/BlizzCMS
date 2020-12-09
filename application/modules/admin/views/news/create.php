    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('admin_nav_news'); ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin'); ?>"><?= lang('admin_nav_dashboard'); ?></a></li>
              <li><span><?= lang('admin_nav_news'); ?></span></li>
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
            <h4 class="uk-h4"><i class="fas fa-pen"></i> <?= lang('placeholder_create_news'); ?></h4>
          </div>
          <div class="uk-card-body">
            <div class="uk-margin-small">
              <label class="uk-form-label"><?= lang('placeholder_title'); ?></label>
              <div class="uk-form-controls">
                <input class="uk-input uk-width-1-1" type="text" name="title" placeholder="<?= lang('placeholder_title'); ?>">
              </div>
              <?= form_error('title', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
            </div>
            <div class="uk-margin-small">
              <label class="uk-form-label"><?= lang('placeholder_description'); ?></label>
              <div class="uk-form-controls">
                <textarea class="uk-textarea tinyeditor" name="description" rows="12"></textarea>
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
                    <button class="uk-button uk-button-primary" type="button" tabindex="-1"><i class="fas fa-file-upload"></i> <?= lang('button_select'); ?></button>
                  </div>
                </div>
              </div>
              <?= form_error('image', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
            </div>
          </div>
        </div>
        <button class="uk-button uk-button-primary uk-margin-small" type="submit"><i class="fas fa-plus"></i> <?= lang('button_create'); ?></button>
        <?= form_close(); ?>
      </div>
    </section>