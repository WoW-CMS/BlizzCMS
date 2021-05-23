    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('menu') ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
              <li><span><?= lang('menu') ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('admin/menu') ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <?= $template['partials']['alerts'] ?>
        <?= form_open(current_url()) ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-pen"></i> <?= lang('create_menu') ?></h5>
          </div>
          <div class="uk-card-body">
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('name') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" type="text" name="name" value="<?= set_value('name') ?>" placeholder="<?= lang('name') ?>">
                  </div>
                  <?= form_error('name', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('url') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" type="text" name="url" value="<?= set_value('url') ?>" placeholder="<?= lang('url') ?>">
                  </div>
                  <?= form_error('url', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('icon') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" type="text" name="icon" value="<?= set_value('icon') ?>" placeholder="<?= lang('icon') ?>">
                  </div>
                  <?= form_error('icon', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('target') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="target">
                      <option value="" hidden selected><?= lang('select_target') ?></option>
                      <option value="<?= TYPE_SELF_TAB ?>" <?= set_select('target', TYPE_SELF_TAB) ?>><?= lang('same_tab') ?></option>
                      <option value="<?= TYPE_BLANK_TAB ?>" <?= set_select('target', TYPE_BLANK_TAB) ?>><?= lang('new_tab') ?></option>
                    </select>
                  </div>
                  <?= form_error('target', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('type') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="type">
                      <option value="" hidden selected><?= lang('select_type') ?></option>
                      <option value="<?= TYPE_DEFAULT ?>" <?= set_select('type', TYPE_DEFAULT) ?>><?= lang('default') ?></option>
                      <option value="<?= TYPE_DROPDOWN ?>" <?= set_select('type', TYPE_DROPDOWN) ?>><?= lang('dropdown') ?></option>
                    </select>
                  </div>
                  <?= form_error('type', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('parent') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="parent">
                      <option value="" hidden selected><?= lang('select_parent') ?></option>
                      <option value="0" <?= set_select('parent', '0') ?>><?= lang('whithout_parent') ?></option>
                      <?php foreach ($parents as $item): ?>
                      <option value="<?= $item->id ?>" <?= set_select('parent', $item->id) ?>><?= $item->name ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <?= form_error('parent', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="uk-button uk-button-primary uk-margin-small" type="submit"><i class="fas fa-plus"></i> <?= lang('create') ?></button>
        <?= form_close() ?>
      </div>
    </section>