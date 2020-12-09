    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('admin_nav_menu'); ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin'); ?>"><?= lang('admin_nav_dashboard'); ?></a></li>
              <li><span><?= lang('admin_nav_menu'); ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('admin/menu'); ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <?= $template['partials']['alerts']; ?>
        <?= form_open(current_url()); ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h4 class="uk-h4"><i class="fas fa-pen"></i> <?= lang('placeholder_create_menu'); ?></h4>
          </div>
          <div class="uk-card-body">
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_name'); ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" type="text" name="name" placeholder="<?= lang('placeholder_name'); ?>">
                  </div>
                  <?= form_error('name', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_url'); ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" type="text" name="url" placeholder="<?= lang('placeholder_url'); ?>">
                  </div>
                  <?= form_error('url', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_icon'); ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" type="text" name="icon" placeholder="<?= lang('placeholder_icon'); ?>">
                  </div>
                  <?= form_error('icon', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_target'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="target">
                      <option value="" hidden selected><?= lang('notification_select_target'); ?></option>
                      <option value="1"><?= lang('option_same_tab'); ?></option>
                      <option value="2"><?= lang('option_new_tab'); ?></option>
                    </select>
                  </div>
                  <?= form_error('target', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_type'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="type">
                      <option value="" hidden selected><?= lang('notification_select_type'); ?></option>
                      <option value="1"><?= lang('option_normal'); ?></option>
                      <option value="2"><?= lang('option_dropdown'); ?></option>
                    </select>
                  </div>
                  <?= form_error('type', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_parent'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="parent">
                      <option value="" hidden selected><?= lang('notification_select_parent'); ?></option>
                      <option value="0"><?= lang('option_whithout_parent'); ?></option>
                      <?php foreach ($parents as $item): ?>
                      <option value="<?= $item->id; ?>"><?= $item->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <?= form_error('parent', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="uk-button uk-button-primary uk-margin-small" type="submit"><i class="fas fa-plus"></i> <?= lang('button_create'); ?></button>
        <?= form_close(); ?>
      </div>
    </section>