<?php
if (isset($_POST['button_createRealm'])):
  $hostname = $_POST['hostname'];
  $username = $_POST['host_user'];
  $password = $_POST['host_pass'];
  $database = $_POST['host_db'];
  $realm_id = $_POST['realmid'];
  $soaphost = $_POST['soap_hostname'];
  $soapuser = $_POST['soap_user'];
  $soappass = $_POST['soap_pass'];
  $soapport = $_POST['soap_port'];

  $this->m_modules->insertRealm($hostname, $username, $password, $database, $realm_id, $soaphost, $soapuser, $soappass, $soapport, '1');
endif; ?>

    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-server"></i> Add Realm</h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/realms'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('table_header_realm_id'); ?></label>
                <div class="uk-form-controls">
                  <input class="uk-input" type="number" name="realmid" placeholder="Auth -> realmlist -> ID" required>
                </div>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase">Soap Hostname</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="soap_hostname" placeholder="Example: 127.0.0.1" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase">Soap User</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="soap_user" placeholder="Example: blizzcms" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase">Soap Password</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="password" name="soap_pass" placeholder="Example: ascent" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase">Soap Port</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="number" name="soap_port" placeholder="Example: 7878" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase"><strong>Character</strong> Database Hostname</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="hostname" placeholder="Example: 127.0.0.1" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase"><strong>Character</strong> Database User</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="host_user" placeholder="Example: root" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase"><strong>Character</strong> Database Password</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="password" name="host_pass" placeholder="Example: ascent" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase"><strong>Character</strong> Database Name</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="host_db" placeholder="Example: characters" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <button class="uk-button uk-button-primary uk-width-1-1" name="button_createRealm" type="submit"><i class="fas fa-check-circle"></i> <?= $this->lang->line('button_create'); ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
