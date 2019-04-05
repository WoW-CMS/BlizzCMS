    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-sliders-h"></i> <?= $this->lang->line('admin_nav_manage_settings'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="" class="uk-icon-button"><i class="fas fa-info"></i></a>
          </div>
        </div>
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-1-4@s">
            <div class="uk-card uk-card-secondary">
              <ul class="uk-nav uk-nav-default">
                <li><a href="<?= base_url('admin/settings'); ?>"><i class="fas fa-cog"></i> General Settings</a></li>
                <li><a href="<?= base_url('admin/settings/database'); ?>"><i class="fas fa-database"></i> Databases Settings</a></li>
                <li class="uk-active"><a href="<?= base_url('admin/settings/optional'); ?>"><i class="fas fa-layer-group"></i> Optional Settings</a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@s">
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-body">
                <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-text-center uk-margin-small"><span>Optional Settings</span></h5>
                <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-small">Ranks</h5>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">Administrator GMLevel</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-crown"></i></span>
                          <input class="uk-input" type="text" name="adminLevel" value="<?= $this->config->item('admin_access_level'); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">Moderator GMLevel</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-gavel"></i></span>
                          <input class="uk-input" type="text" name="modLevel" value="<?= $this->config->item('mod_access_level'); ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom">reCaptcha</h5>
                <div class="uk-margin-small">
                  <label class="uk-form-label">reCaptcha Site Key</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-key"></i></span>
                      <input class="uk-input" type="text" name="recaptchaKey" value="<?= $this->config->item('recaptcha_sitekey'); ?>" required>
                    </div>
                  </div>
                </div>
                <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom">Register</h5>
                <div class="uk-alert-danger uk-margin-small" uk-alert>
                  <p><i class="fas fa-exclamation-circle"></i> If you enable this option, you must configure SMTP to send emails.</p>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label">Account Activation</label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="registerType">
                      <option value="TRUE" <?php if($this->config->item('account_activation_required') == TRUE) echo 'selected'; ?>>Enabled</option>
                      <option value="FALSE" <?php if($this->config->item('account_activation_required') == FALSE) echo 'selected'; ?>>Disabled</option>
                    </select>
                  </div>
                </div>
                <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom">SMTP</h5>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">SMTP Hostname</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-mail-bulk"></i></span>
                          <input class="uk-input" type="text" name="smtpHost" value="<?= $this->config->item('smtp_host'); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-4@s">
                      <label class="uk-form-label">SMTP Port</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <input class="uk-input" type="number" name="smtpPort" value="<?= $this->config->item('smtp_port'); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-4@s">
                      <label class="uk-form-label">SMTP Encryption</label>
                      <div class="uk-form-controls">
                        <select class="uk-select" name="smtpCrypto">
                          <option value="ssl" <?php if($this->config->item('smtp_crypto') == 'ssl') echo 'selected'; ?>>SSL</option>
                          <option value="tls" <?php if($this->config->item('smtp_crypto') == 'tls') echo 'selected'; ?>>TLS</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">SMTP Username</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-user"></i></span>
                          <input class="uk-input" type="text" name="smtpUser" value="<?= $this->config->item('smtp_user'); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">SMTP Password</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-key"></i></span>
                          <input class="uk-input" type="text" name="smtpPass" value="<?= $this->config->item('smtp_pass'); ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">Sender Email</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-envelope"></i></span>
                          <input class="uk-input" type="email" name="senderEmail" value="<?= $this->config->item('email_settings_sender'); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">Sender Name</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-user-circle"></i></span>
                          <input class="uk-input" type="text" name="senderName" value="<?= $this->config->item('email_settings_sender_name'); ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-primary uk-width-1-1" name="submitCaptcha" type="submit"><i class="fas fa-sync"></i> Update</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
