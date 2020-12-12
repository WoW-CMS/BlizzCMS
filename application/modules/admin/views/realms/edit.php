    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('admin_nav_realms'); ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin'); ?>"><?= lang('admin_nav_dashboard'); ?></a></li>
              <li><span><?= lang('admin_nav_realms'); ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('admin/realms'); ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <?= $template['partials']['alerts']; ?>
        <?= form_open(current_url()); ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h4 class="uk-h4"><i class="fas fa-pen"></i> <?= lang('edit_realm'); ?></h4>
          </div>
          <div class="uk-card-body">
            <div class="uk-margin-small-bottom">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('name'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-server"></i></span>
                      <input class="uk-input" type="text" name="name" value="<?= $realm->name; ?>" placeholder="<?= lang('name'); ?>">
                    </div>
                  </div>
                  <?= form_error('name', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('maximum_capacity'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-users"></i></span>
                      <input class="uk-input" type="text" name="max_cap" value="<?= $realm->max_cap; ?>" placeholder="<?= lang('maximum_capacity'); ?>">
                    </div>
                  </div>
                  <?= form_error('max_cap', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom uk-heading-line"><span><?= lang('character_database'); ?></span></h5>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('hostname'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-server"></i></span>
                      <input class="uk-input" type="text" name="char_host" value="<?= $realm->char_hostname; ?>" placeholder="<?= lang('hostname'); ?>">
                    </div>
                  </div>
                  <?= form_error('char_host', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-inline uk-width-1-4@s">
                  <label class="uk-form-label"><?= lang('port'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-ethernet"></i></span>
                      <input class="uk-input" type="text" name="char_port" value="<?= $realm->char_port; ?>" placeholder="<?= lang('port'); ?>">
                    </div>
                  </div>
                  <?= form_error('char_port', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-inline uk-width-1-4@s">
                  <label class="uk-form-label"><?= lang('database'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-database"></i></span>
                      <input class="uk-input" type="text" name="char_db" value="<?= $realm->char_database; ?>" placeholder="<?= lang('database'); ?>">
                    </div>
                  </div>
                  <?= form_error('char_db', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('username'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-user-circle"></i></span>
                      <input class="uk-input" type="text" name="char_user" value="<?= $realm->char_username; ?>" placeholder="<?= lang('username'); ?>">
                    </div>
                  </div>
                  <?= form_error('char_user', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('password'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-key"></i></span>
                      <input class="uk-input" type="password" name="char_pass" placeholder="<?= lang('password'); ?>">
                    </div>
                  </div>
                  <?= form_error('char_pass', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom uk-heading-line"><span><?= lang('soap_configuration'); ?></span></h5>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('hostname'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-server"></i></span>
                      <input class="uk-input" type="text" name="console_host" value="<?= $realm->console_hostname; ?>" placeholder="<?= lang('hostname'); ?>">
                    </div>
                  </div>
                  <?= form_error('console_host', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('port'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-ethernet"></i></span>
                      <input class="uk-input" type="text" name="console_port" value="<?= $realm->console_port; ?>" placeholder="<?= lang('port'); ?>">
                    </div>
                  </div>
                  <?= form_error('console_port', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('username'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-user-circle"></i></span>
                      <input class="uk-input" type="text" name="console_user" value="<?= $realm->console_username; ?>" placeholder="<?= lang('username'); ?>">
                    </div>
                  </div>
                  <?= form_error('console_user', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('password'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-key"></i></span>
                      <input class="uk-input" type="password" name="console_pass" placeholder="<?= lang('password'); ?>">
                    </div>
                  </div>
                  <?= form_error('console_pass', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom uk-heading-line"><span><?= lang('realm_check'); ?></span></h5>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('hostname'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-server"></i></span>
                      <input class="uk-input" type="text" name="realm_host" value="<?= $realm->realm_hostname; ?>" placeholder="<?= lang('hostname'); ?>">
                    </div>
                  </div>
                  <?= form_error('realm_host', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('port'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-ethernet"></i></span>
                      <input class="uk-input" type="text" name="realm_port" value="<?= $realm->realm_port; ?>" placeholder="<?= lang('port'); ?>">
                    </div>
                  </div>
                  <?= form_error('realm_port', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="uk-button uk-button-primary uk-margin-small" type="submit"><i class="fas fa-save"></i> <?= lang('save'); ?></button>
        <?= form_close(); ?>
      </div>
    </section>