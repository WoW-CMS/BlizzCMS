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

      <div id="newRealm" uk-modal="bg-close: false">
        <div class="uk-modal-dialog">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="uk-modal-header">
            <h3 class="uk-modal-title uk-text-uppercase"><i class="fas fa-server"></i> Add Realm</h3>
          </div>
          <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
            <div class="uk-modal-body">
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
            </div>
            <div class="uk-modal-footer uk-text-right actions">
              <button class="uk-button uk-button-danger uk-modal-close" type="button"><?= $this->lang->line('button_cancel'); ?></button>
              <button class="uk-button uk-button-primary" type="submit" name="button_createRealm"><?= $this->lang->line('button_create'); ?></button>
            </div>
          </form>
        </div>
      </div>

      <div id="newSlide" uk-modal="bg-close: false">
        <div class="uk-modal-dialog">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="uk-modal-header">
            <h3 class="uk-modal-title uk-text-uppercase"><i class="far fa-image"></i> Add Image to Slideshow</h3>
          </div>
          <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
            <div class="uk-modal-body">
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_title'); ?></label>
                <div class="uk-form-controls">
                  <input class="uk-input" type="text" name="slide_title" placeholder="<?= $this->lang->line('placeholder_title'); ?>" required>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_upload_file'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <div uk-form-custom="target: true">
                      <input type="file" required name="slide_imageup">
                      <input class="uk-input uk-form-width-medium" type="text" placeholder="Select file" disabled>
                      <button class="uk-button uk-button-primary" type="button" tabindex="-1"><i class="fas fa-file-upload"></i> Select</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-modal-footer uk-text-right actions">
              <button class="uk-button uk-button-danger uk-modal-close" type="button"><?= $this->lang->line('button_cancel'); ?></button>
              <button class="uk-button uk-button-primary" type="submit" name="button_createSlide"><?= $this->lang->line('button_create'); ?></button>
            </div>
          </form>
        </div>
      </div>
