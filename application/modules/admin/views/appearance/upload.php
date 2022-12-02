<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/appearance') ?>"><?= lang('appearance') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('upload_file') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <?= form_open_multipart(current_url()) ?>
      <div class="uk-card uk-card-default uk-card-body uk-margin">
        <div class="uk-placeholder uk-text-center">
          <span class="uk-text-middle"><i class="fa-solid fa-file-arrow-up"></i> <?= lang('attach_zip_file') ?></span>
          <div uk-form-custom>
            <input type="file" name="file">
            <span class="uk-link"><?= lang('selecting_one') ?></span>
          </div>
          <?= form_error('file', '<p class="uk-margin-small uk-text-small uk-text-danger">', '</p>') ?>
        </div>
      </div>
      <button class="uk-button uk-button-primary" type="submit"><?= lang('upload') ?></button>
    <?= form_close() ?>
  </div>
</section>
