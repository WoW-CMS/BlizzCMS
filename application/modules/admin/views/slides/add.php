<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/appearance') ?>"><?= lang('appearance') ?></a></li>
          <li><a href="<?= site_url('admin/slides') ?>"><?= lang('slides') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('add_slide') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <?= form_open_multipart(current_url()) ?>
      <div class="uk-margin" uk-grid>
        <div class="uk-width-3-5@s uk-width-2-3@m">
          <div class="uk-card uk-card-default uk-margin">
            <div class="uk-card-body">
              <div class="uk-grid-small uk-margin-small" uk-grid>
                <div class="uk-width-1-1">
                  <label class="uk-form-label"><?= lang('title') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="title" value="<?= set_value('title') ?>" placeholder="<?= lang('title') ?>" autocomplete="off">
                  </div>
                  <?= form_error('title', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-1">
                  <label class="uk-form-label"><?= lang('description') ?></label>
                  <div class="uk-form-controls">
                    <textarea class="uk-textarea" name="description" rows="4" autocomplete="off"><?= set_value('description') ?></textarea>
                  </div>
                  <?= form_error('description', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
          </div>
          <button class="uk-button uk-button-primary uk-visible@s" type="submit"><?= lang('add') ?></button>
        </div>
        <div class="uk-width-2-5@s uk-width-1-3@m">
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <h3 class="uk-card-title"><i class="fa-solid fa-photo-film"></i> <?= lang('file') ?></h3>
            </div>
            <div class="uk-card-body">
              <div id="mfp_container" class="uk-placeholder uk-padding-small uk-margin-small-bottom">
                <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-text-center uk-margin-medium-top uk-margin-medium-bottom"><i class="fa-solid fa-photo-film"></i> <?= lang('file_not_loaded') ?></h5>
              </div>
              <div class="uk-margin-small-top">
                <div class="uk-form-controls">
                  <div class="uk-display-block" uk-form-custom>
                    <input class="mfp-input" type="file" id="slide_file" name="file" data-container="mfp_container">
                    <button class="uk-button uk-button-default uk-width-1-1" type="button" tabindex="-1"><i class="fa-solid fa-upload"></i> <?= lang('select') ?></button>
                  </div>
                </div>
                <?= form_error('file', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="uk-button uk-button-primary uk-hidden@s" type="submit"><?= lang('add') ?></button>
    <?= form_close() ?>
  </div>
</section>
