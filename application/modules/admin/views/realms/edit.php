<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/realms') ?>"><?= lang('realms') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('edit_realm') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <?= form_open(current_url()) ?>
      <div class="uk-card uk-card-default">
        <div class="uk-card-body">
          <div class="uk-grid-small uk-margin-small" uk-grid>
            <div class="uk-width-1-2@s">
              <label class="uk-form-label"><?= lang('name') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="realm_name" value="<?= $realm->realm_name ?>" placeholder="<?= lang('name') ?>" autocomplete="off">
              </div>
              <?= form_error('realm_name', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-2@s">
              <label class="uk-form-label"><?= lang('maximum_capacity') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="realm_capacity" value="<?= $realm->realm_capacity ?>" placeholder="<?= lang('maximum_capacity') ?>" autocomplete="off">
              </div>
              <?= form_error('realm_capacity', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
          </div>
        </div>
      </div>
      <h6 class="uk-h6 uk-text-bold uk-text-uppercase uk-margin-top uk-margin-remove-bottom"><?= lang('characters_database') ?></h6>
      <div class="uk-card uk-card-default uk-margin-small-top">
        <div class="uk-card-body">
          <div class="uk-grid-small uk-margin-small-bottom" uk-grid>
            <div class="uk-width-1-2@s">
              <label class="uk-form-label"><?= lang('hostname') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="char_hostname" value="<?= $realm->char_hostname ?>" placeholder="<?= lang('hostname') ?>" autocomplete="off">
              </div>
              <?= form_error('char_hostname', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-4@s">
              <label class="uk-form-label"><?= lang('port') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="char_port" value="<?= $realm->char_port ?>" placeholder="<?= lang('port') ?>" autocomplete="off">
              </div>
              <?= form_error('char_port', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-4@s">
              <label class="uk-form-label"><?= lang('database') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="char_database" value="<?= $realm->char_database ?>" placeholder="<?= lang('database') ?>" autocomplete="off">
              </div>
              <?= form_error('char_database', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
          </div>
          <div class="uk-grid-small uk-margin-small-top" uk-grid>
            <div class="uk-width-1-2@s">
              <label class="uk-form-label"><?= lang('username') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="char_username" value="<?= $realm->char_username ?>" placeholder="<?= lang('username') ?>" autocomplete="off">
              </div>
              <?= form_error('char_username', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-2@s">
              <label class="uk-form-label"><?= lang('password') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="password" name="char_password" placeholder="••••••••••••••••••••" autocomplete="new-password">
              </div>
              <?= form_error('char_password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
          </div>
        </div>
      </div>
      <h6 class="uk-h6 uk-text-bold uk-text-uppercase uk-margin-top uk-margin-remove-bottom"><?= lang('soap_configuration') ?></h6>
      <div class="uk-card uk-card-default uk-margin-small-top">
        <div class="uk-card-body">
          <div class="uk-grid-small uk-margin-small-bottom" uk-grid>
            <div class="uk-width-1-2@s">
              <label class="uk-form-label"><?= lang('hostname') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="console_hostname" value="<?= $realm->console_hostname ?>" placeholder="<?= lang('hostname') ?>" autocomplete="off">
              </div>
              <?= form_error('console_hostname', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-2@s">
              <label class="uk-form-label"><?= lang('port') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="console_port" value="<?= $realm->console_port ?>" placeholder="<?= lang('port') ?>" autocomplete="off">
              </div>
              <?= form_error('console_port', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
          </div>
          <div class="uk-grid-small uk-margin-small-top" uk-grid>
            <div class="uk-width-1-2@s">
              <label class="uk-form-label"><?= lang('username') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="console_username" value="<?= $realm->console_username ?>" placeholder="<?= lang('username') ?>" autocomplete="off">
              </div>
              <?= form_error('console_username', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-2@s">
              <label class="uk-form-label"><?= lang('password') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="password" name="console_password" placeholder="••••••••••••••••••••" autocomplete="new-password">
              </div>
              <?= form_error('console_password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
          </div>
        </div>
      </div>
      <h6 class="uk-h6 uk-text-bold uk-text-uppercase uk-margin-top uk-margin-remove-bottom"><?= lang('check_realm_status') ?></h6>
      <div class="uk-card uk-card-default uk-margin-small-top uk-margin-bottom">
        <div class="uk-card-body">
          <div class="uk-grid-small" uk-grid>
            <div class="uk-width-1-2@s">
              <label class="uk-form-label"><?= lang('hostname') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="realm_hostname" value="<?= $realm->realm_hostname ?>" placeholder="<?= lang('hostname') ?>" autocomplete="off">
              </div>
              <?= form_error('realm_hostname', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-2@s">
              <label class="uk-form-label"><?= lang('port') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="realm_port" value="<?= $realm->realm_port ?>" placeholder="<?= lang('port') ?>" autocomplete="off">
              </div>
              <?= form_error('realm_port', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
          </div>
        </div>
      </div>
      <button class="uk-button uk-button-primary" type="submit"><?= lang('save') ?></button>
    <?= form_close() ?>
  </div>
</section>
