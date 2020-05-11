    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <?php if($this->wowmodule->getUCPStatus() == '1'): ?>
              <li class="uk-active"><a href="<?= base_url('panel'); ?>"><i class="fas fa-user-circle"></i> <?= $this->lang->line('tab_account'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->wowmodule->getDonationStatus() == '1'): ?>
              <li><a href="<?= base_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?=$this->lang->line('navbar_donate_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getVoteStatus() == '1'): ?>
              <li><a href="<?= base_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?=$this->lang->line('navbar_vote_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getStoreStatus() == '1'): ?>
              <li><a href="<?= base_url('store'); ?>"><i class="fas fa-store"></i> <?=$this->lang->line('tab_store'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->wowmodule->getBugtrackerStatus() == '1'): ?>
              <li><a href="<?= base_url('bugtracker'); ?>"><i class="fas fa-bug"></i> <?=$this->lang->line('tab_bugtracker'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getChangelogsStatus() == '1'): ?>
              <li><a href="<?= base_url('changelogs'); ?>"><i class="fas fa-scroll"></i> <?=$this->lang->line('tab_changelogs'); ?></a></li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= $this->lang->line('button_account_settings'); ?></h4>
            <!-- Start div change username -->
            <div class="uk-card-default myaccount-card uk-margin-small">
                <div class="uk-card-header">
                  <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-users"></i> <?= $this->lang->line('panel_change_username'); ?></h5>
                </div>

                <!-- Start card body changeUsername -->
                <div class="uk-card-body">
                  <?= form_open('', 'id="changeUsernameForm" onsubmit="ChangeUsernameForm(event)"') ?>
                    <div class="uk-margin uk-light">
                      <label class="uk-form-label"><?= $this->lang->line('panel_current_username'); ?>: </label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon"><i class="fas fa-user fa-lg"></i></span>
                          <input class="uk-input uk-disabled" type="text" placeholder="<?= $this->wowauth->getSiteUsernameID($this->session->userdata('wow_sess_id')); ?>" disabled>
                        </div>
                      </div>
                    <div class="uk-margin uk-light">
                      <label class="uk-form-label"><?= $this->lang->line('placeholder_new_username'); ?>:</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon"><i class="far fa-user fa-lg"></i> </span>
                          <input class="uk-input" id="new_username" type="text" placeholder="<?= $this->lang->line('placeholder_new_username'); ?>" required>
                        </div>
                      </div>
                    </div>
                  <div class="uk-margin uk-light">
                    <div class="uk-form-controls">
                      <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon"><i class="fas fa-key fa-lg"></i></span>
                        <input class="uk-input" id="user_current_password" type="password" pattern=".{5,16}" placeholder="<?= $this->lang->line('placeholder_password'); ?>" required>
                      </div>
                    </div>
                  </div>
                </div>
                  <div class="uk-margin">
                    <button class="uk-button uk-button-default uk-width-1-1"><i class="fas fa-sync"></i> Guardar Cambios</button>
                  </div>
                  <?= form_close(); ?>
                </div>
            </div>
            <div class="uk-card-default myaccount-card uk-margin-small">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-envelope"></i> <?= $this->lang->line('panel_change_email'); ?></h5>
              </div>
              <div class="uk-card-body">
                <?= form_open('', 'id="changeemailForm" onsubmit="ChangeEmailForm(event)"'); ?>
                <div class="uk-margin uk-light">
                  <label class="uk-form-label"><?= $this->lang->line('panel_current_email'); ?>:</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-envelope fa-lg"></i></span>
                      <input class="uk-input uk-disabled" type="email" placeholder="<?= $this->wowauth->getEmailID($this->session->userdata('wow_sess_id')); ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= $this->lang->line('panel_replace_email_by'); ?></label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon"><i class="far fa-envelope fa-lg"></i></span>
                          <input class="uk-input" id="new_email" type="email" placeholder="<?= $this->lang->line('placeholder_new_email'); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= $this->lang->line('placeholder_confirm_email'); ?></label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon"><i class="far fa-envelope fa-lg"></i></span>
                          <input class="uk-input" id="renew_email" type="email" placeholder="<?= $this->lang->line('placeholder_confirm_email'); ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-key fa-lg"></i></span>
                      <input class="uk-input" id="current_password" type="password" pattern=".{5,16}" placeholder="<?= $this->lang->line('placeholder_password'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-default uk-width-1-1"><i class="fas fa-sync"></i> <?= $this->lang->line('button_save_changes'); ?></button>
                </div>
                <?= form_close(); ?>
              </div>
            </div>
            <div class="uk-card-default myaccount-card uk-margin-small">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-key"></i> <?= $this->lang->line('panel_change_password'); ?></h5>
              </div>
              <div class="uk-card-body">
                <?= form_open('', 'id="changepasswordForm" onsubmit="ChangePasswordForm(event)"'); ?>
                <div class="uk-margin uk-light">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_current_password'); ?>:</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-key fa-lg"></i></span>
                      <input class="uk-input" id="old_password" type="password" pattern=".{5,16}" placeholder="<?= $this->lang->line('placeholder_current_password'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= $this->lang->line('panel_replace_pass_by'); ?></label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon"><i class="fas fa-unlock fa-lg"></i></span>
                          <input class="uk-input" id="new_password" type="password" pattern=".{5,16}" placeholder="<?= $this->lang->line('placeholder_new_password'); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= $this->lang->line('placeholder_re_password'); ?></label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon"><i class="fas fa-lock fa-lg"></i></span>
                          <input class="uk-input" id="renew_password" type="password" pattern=".{5,16}" placeholder="<?= $this->lang->line('placeholder_re_password'); ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-default uk-width-1-1"><i class="fas fa-sync"></i> <?= $this->lang->line('button_save_changes'); ?></button>
                </div>
                <?= form_close(); ?>
              </div>
            </div>
            <div class="uk-card-default myaccount-card uk-margin-small">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-id-badge"></i> <?= $this->lang->line('button_change_avatar'); ?></h5>
              </div>
              <div class="uk-card-body">
                <?= form_open('', 'id="changeavatarForm" onsubmit="ChangeAvatarForm(event)"'); ?>
                <div class="uk-margin uk-light">
                  <div class="uk-form-controls">
                    <div class="uk-grid uk-child-width-auto uk-flex uk-flex-center" data-uk-grid>
                      <?php foreach($this->user_model->getAllAvatars()->result() as $avatar): ?>
                        <div>
                          <img class="uk-border-rounded uk-margin-small" src="<?= base_url('assets/images/profiles/'.$avatar->name); ?>" width="60" height="60">
                          <input class="uk-radio uk-display-block uk-margin-auto-left uk-margin-auto-right change_avatar" type="radio" name="change_avatar" value="<?= $avatar->id ?>" <?php if($this->wowauth->getImageProfile($this->session->userdata('wow_sess_id')) == $avatar->id) echo 'checked'; ?>>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-default uk-width-1-1"><i class="fas fa-sync"></i> <?= $this->lang->line('button_save_changes'); ?></button>
                </div>
                <?= form_close(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
      function ChangeUsernameForm(e) {
        e.preventDefault();

        var newusername = $('#new_username').val();
        var password = $('#user_current_password').val();

        if(newusername == '') {
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?=$this->lang->line('notification_title_error'); ?>',
              message: '<?=$this->lang->line('notification_username_empty');?>',
              info: '',
              icon: 'fas fa-times-circle'
            },
            'delay': 5000,
            'position': 'top right',
            'inEffect': 'slideRight',
            'outEffect': 'slideRight'
          });
          return false;
        }
        $.ajax({
          url:"<?= base_url($lang.'/changeusername'); ?>",
          method:"POST",
          data:{newusername, password},
          dataType:"text",
          beforeSend: function(){
            $.amaran({
              'theme': 'awesome info',
              'content': {
                title: '<?= $this->lang->line('notification_title_info'); ?>',
                message: '<?= $this->lang->line('notification_checking'); ?>',
                info: '',
                icon: 'fas fa-sign-in-alt'
              },
              'delay': 5000,
              'position': 'top right',
              'inEffect': 'slideRight',
              'outEffect': 'slideRight'
            });
          },
          success:function(response){
            if(!response)
              alert(response);

            if (response == 'epassnotMatch') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('notification_usernamepass_not_match'); ?>',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              $('#changeemailForm')[0].reset();
              return false;
            }

            if (response) {
              $.amaran({
                'theme': 'awesome ok',
                  'content': {
                  title: '<?= $this->lang->line('notification_title_success'); ?>',
                  message: '<?= $this->lang->line('notification_username_changed'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }

            $('#changeUsernameForm')[0].reset();
            window.location.replace("<?= base_url('logout'); ?>");
          }
        });
      }
                        
      function ChangeEmailForm(e) {
        e.preventDefault();

        var newemail = $('#new_email').val();
        var renewemail = $('#renew_email').val();
        var password = $('#current_password').val();
        if(newemail == '' || renewemail == ''){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: '<?= $this->lang->line('notification_email_empty'); ?>',
              info: '',
              icon: 'fas fa-times-circle'
            },
            'delay': 5000,
            'position': 'top right',
            'inEffect': 'slideRight',
            'outEffect': 'slideRight'
          });
          return false;
        }

        if(password == ''){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: '<?= $this->lang->line('notification_password_empty'); ?>',
              info: '',
              icon: 'fas fa-times-circle'
            },
            'delay': 5000,
            'position': 'top right',
            'inEffect': 'slideRight',
            'outEffect': 'slideRight'
          });
          return false;
        }

        $.ajax({
          url:"<?= base_url($lang.'/changemail'); ?>",
          method:"POST",
          data:{newemail, renewemail, password},
          dataType:"text",
          beforeSend: function(){
            $.amaran({
              'theme': 'awesome info',
              'content': {
                title: '<?= $this->lang->line('notification_title_info'); ?>',
                message: '<?= $this->lang->line('notification_checking'); ?>',
                info: '',
                icon: 'fas fa-sign-in-alt'
              },
              'delay': 5000,
              'position': 'top right',
              'inEffect': 'slideRight',
              'outEffect': 'slideRight'
            });
          },
          success:function(response){
            if(!response)
              alert(response);

            if (response == 'expaError') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('expansion_notfound'); ?>',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              $('#changeemailForm')[0].reset();
              return false;
            }

            if (response == 'epassnotMatch') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('notification_currentpass_not_match'); ?>',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              $('#changeemailForm')[0].reset();
              return false;
            }

            if (response == 'enoMatch') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('notification_email_not_match'); ?>',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              $('#changeemailForm')[0].reset();
              return false;
            }

            if (response == 'usedEmail') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('notification_used_email'); ?>',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              $('#changeemailForm')[0].reset();
              return false;
            }

            if (response) {
              $.amaran({
                'theme': 'awesome ok',
                  'content': {
                  title: '<?= $this->lang->line('notification_title_success'); ?>',
                  message: '<?= $this->lang->line('notification_email_changed'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#changeemailForm')[0].reset();
            window.location.replace("<?= base_url('logout'); ?>");
          }
        });
      }
      function ChangePasswordForm(e) {
        e.preventDefault();

        var oldpass = $('#old_password').val();
        var newpass = $('#new_password').val();
        var renewpass = $('#renew_password').val();
        if(oldpass == '' || newpass == '' || renewpass == ''){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: '<?= $this->lang->line('notification_password_empty'); ?>',
              info: '',
              icon: 'fas fa-times-circle'
            },
            'delay': 5000,
            'position': 'top right',
            'inEffect': 'slideRight',
            'outEffect': 'slideRight'
          });
          return false;
        }
        $.ajax({
          url:"<?= base_url($lang.'/changepass'); ?>",
          method:"POST",
          data:{oldpass, newpass, renewpass},
          dataType:"text",
          beforeSend: function(){
            $.amaran({
              'theme': 'awesome info',
              'content': {
                title: '<?= $this->lang->line('notification_title_info'); ?>',
                message: '<?= $this->lang->line('notification_checking'); ?>',
                info: '',
                icon: 'fas fa-sign-in-alt'
              },
              'delay': 5000,
              'position': 'top right',
              'inEffect': 'slideRight',
              'outEffect': 'slideRight'
            });
          },
          success:function(response){
            if(!response)
              alert(response);

            if (response == 'expError') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('expansion_notfound'); ?>',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              $('#changepasswordForm')[0].reset();
              return false;
            }

            if (response == 'passnotMatch') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('notification_currentpass_not_match'); ?>',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              $('#changepasswordForm')[0].reset();
              return false;
            }

            if (response == 'lengError') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('notification_password_lenght_error'); ?>',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              $('#changepasswordForm')[0].reset();
              return false;
            }

            if (response == 'samePass') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('notification_same_password'); ?>',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              $('#changepasswordForm')[0].reset();
              return false;
            }

            if (response == 'noMatch') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('notification_password_not_match'); ?>',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              $('#changepasswordForm')[0].reset();
              return false;
            }

            if (response) {
              $.amaran({
                'theme': 'awesome ok',
                  'content': {
                  title: '<?= $this->lang->line('notification_title_success'); ?>',
                  message: '<?= $this->lang->line('notification_password_changed'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#changepasswordForm')[0].reset();
            window.location.replace("<?= base_url('logout'); ?>");
          }
        });
      }
      function ChangeAvatarForm(e) {
        e.preventDefault();

        var avatar = $('.change_avatar:checked').val();
        if(avatar == '' || avatar == 0){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: '<?= $this->lang->line('notification_wrong_values'); ?>',
              info: '',
              icon: 'fas fa-times-circle'
            },
            'delay': 5000,
            'position': 'top right',
            'inEffect': 'slideRight',
            'outEffect': 'slideRight'
          });
          return false;
        }
        $.ajax({
          url:"<?= base_url($lang.'/changeavatar'); ?>",
          method:"POST",
          data:{avatar},
          dataType:"text",
          beforeSend: function(){
            $.amaran({
              'theme': 'awesome info',
              'content': {
                title: '<?= $this->lang->line('notification_title_info'); ?>',
                message: '<?= $this->lang->line('notification_checking'); ?>',
                info: '',
                icon: 'fas fa-sign-in-alt'
              },
              'delay': 5000,
              'position': 'top right',
              'inEffect': 'slideRight',
              'outEffect': 'slideRight'
            });
          },
          success:function(response){
            if(!response)
              alert(response);

            if (response) {
              $.amaran({
                'theme': 'awesome ok',
                  'content': {
                  title: '<?= $this->lang->line('notification_title_success'); ?>',
                  message: '<?= $this->lang->line('notification_avatar_changed'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#changeavatarForm')[0].reset();
            window.location.replace("<?= base_url('settings'); ?>");
          }
        });
      }
    </script>
