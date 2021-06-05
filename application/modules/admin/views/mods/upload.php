    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('modules') ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
              <li><a href="<?= site_url('admin/mods') ?>"><?= lang('modules') ?></a></li>
              <li><span><?= lang('upload') ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('admin/mods') ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <?= $template['partials']['alerts'] ?>
        <?= form_open_multipart(current_url()) ?>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="js-upload uk-placeholder uk-text-center">
            <span uk-icon="icon: cloud-upload"></span>
            <span class="uk-text-middle"><?= lang('attach_zip_file') ?></span>
            <div uk-form-custom>
              <input type="file" name="file">
              <span class="uk-link"><?= lang('selecting_one') ?></span>
            </div>
            <?= form_error('file', '<p class="uk-margin-small uk-text-small uk-text-danger">', '</p>') ?>
          </div>
        </div>
        <button class="uk-button uk-button-primary uk-margin-small uk-width-1-1" type="submit"><i class="fas fa-upload"></i> <?= lang('upload') ?></button>
        <?= form_close() ?>
      </div>
    </section>