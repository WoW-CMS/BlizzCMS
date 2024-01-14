<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/appearance') ?>"><?= lang('appearance') ?></a></li>
          <li><a href="<?= site_url('admin/menus') ?>"><?= lang('menus') ?></a></li>
          <li><a href="<?= site_url('admin/menus/'. $menu->id) ?>"><?= html_escape($menu->name) ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('add_menu_item') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <?= form_open(current_url()) ?>
      <div class="uk-margin" uk-grid>
        <div class="uk-width-3-5@s uk-width-2-3@m">
          <div class="uk-card uk-card-default uk-margin">
            <div class="uk-card-body">
              <div class="uk-grid-small uk-margin-small" uk-grid>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('name') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="name" value="<?= set_value('name') ?>" placeholder="<?= lang('name') ?>" autocomplete="off">
                  </div>
                  <?= form_error('name', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('url') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="url" value="<?= set_value('url') ?>" placeholder="<?= lang('url') ?>" autocomplete="off">
                  </div>
                  <?= form_error('url', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('icon') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="icon" value="<?= set_value('icon') ?>" placeholder="<?= lang('icon') ?>" autocomplete="off">
                  </div>
                  <?= form_error('icon', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('target') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select tail-single" id="select_target" name="target" autocomplete="off" data-placeholder="<?= lang('select_target') ?>">
                      <option value="<?= TARGET_SELF ?>" <?= set_select('target', TARGET_SELF) ?>><?= lang('same_tab') ?></option>
                      <option value="<?= TARGET_BLANK ?>" <?= set_select('target', TARGET_BLANK) ?>><?= lang('new_tab') ?></option>
                    </select>
                  </div>
                  <?= form_error('target', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('type') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select tail-single" id="select_type" name="type" autocomplete="off" data-placeholder="<?= lang('select_type') ?>">
                      <option value="<?= ITEM_LINK ?>" <?= set_select('type', ITEM_LINK) ?>><?= lang('link') ?></option>
                      <option value="<?= ITEM_DROPDOWN ?>" <?= set_select('type', ITEM_DROPDOWN) ?>><?= lang('dropdown') ?></option>
                    </select>
                  </div>
                  <?= form_error('type', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('parent') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select tail-single" id="select_parent" name="parent" autocomplete="off" data-placeholder="<?= lang('select_parent') ?>">
                      <option value="0" <?= set_select('parent', '0') ?>><?= lang('no_parent') ?></option>
                      <?php foreach ($parents as $parent): ?>
                      <option value="<?= $parent->id ?>" <?= set_select('parent', $parent->id) ?>><?= $parent->name ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <?= form_error('parent', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
          </div>
          <button class="uk-button uk-button-primary uk-visible@s" type="submit"><?= lang('add') ?></button>
        </div>
        <div class="uk-width-2-5@s uk-width-1-3@m">
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <h3 class="uk-card-title"><i class="fa-solid fa-eye"></i> <?= lang('permissions') ?></h3>
            </div>
            <div class="uk-card-body">
              <div class="uk-grid-small uk-child-width-1-1" uk-grid>
                <?php foreach ($roles as $role): ?>
                <div>
                  <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                      <label class="uk-switch uk-display-block">
                        <input type="checkbox" name="roles[]" value="<?= $role['id'] ?>" <?= set_checkbox('roles[]', $role['id']) ?>>
                        <div class="uk-switch-slider"></div>
                      </label>
                    </div>
                    <div class="uk-width-expand">
                      <p class="uk-text-small uk-text-secondary uk-margin-remove"><?= lang_vars('role_can_view_item', [$role['name']]) ?></p>
                    </div>
                  </div>
                </div>
                <?php endforeach ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="uk-button uk-button-primary uk-hidden@s" type="submit"><?= lang('add') ?></button>
    <?= form_close() ?>
  </div>
</section>
