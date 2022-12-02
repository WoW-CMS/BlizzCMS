<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/appearance') ?>"><?= lang('appearance') ?></a></li>
          <li><a href="<?= site_url('admin/menus') ?>"><?= lang('menus') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('edit_menu') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <?= form_open(current_url()) ?>
      <div class="uk-card uk-card-default uk-margin">
        <div class="uk-card-body">
          <div class="uk-grid-small uk-margin-small" uk-grid>
            <div class="uk-width-1-1">
              <label class="uk-form-label"><?= lang('name') ?></label>
              <div class="uk-form-controls">
                <?php if (! in_array($menu->id, Menu_model::DEFAULT_MENUS)): ?>
                <input class="uk-input" type="text" name="name" value="<?= $menu->name ?>" placeholder="<?= lang('name') ?>" autocomplete="off">
                <?php else: ?>
                <input class="uk-input" type="text" value="<?= $menu->name ?>" placeholder="<?= lang('name') ?>" autocomplete="off" disabled>
                <?php endif ?>
              </div>
              <?= form_error('name', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-1">
              <label class="uk-form-label"><?= lang('description') ?></label>
              <div class="uk-form-controls">
                <textarea class="uk-textarea" name="description" rows="3" autocomplete="off"><?= $menu->description ?></textarea>
              </div>
              <?= form_error('description', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
          </div>
        </div>
      </div>
      <button class="uk-button uk-button-primary" type="submit"><?= lang('save') ?></button>
    <?= form_close() ?>
  </div>
</section>
