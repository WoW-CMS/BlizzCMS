    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <h4 class="uk-h4 uk-heading-line uk-text-uppercase uk-text-bold"><span><i class="fas fa-user-cog"></i> <?= lang('tab_reset'); ?></span></h4>
        <?= form_open('', 'id="recoveryForm" onsubmit="RecoveryForm(event)"'); ?>
        <div class="uk-margin-small uk-light">
          <div class="uk-form-controls">
            <div class="uk-inline uk-width-1-1">
              <span class="uk-form-icon"><i class="fas fa-user fa-lg"></i></span>
              <input class="uk-input" type="text" id="recovery_username" placeholder="<?= lang('placeholder_username'); ?>" required>
            </div>
          </div>
        </div>
        <div class="uk-margin uk-light">
          <div class="uk-form-controls">
            <div class="uk-inline uk-width-1-1">
              <span class="uk-form-icon"><i class="fas fa-envelope fa-lg"></i></span>
              <input class="uk-input" type="email" id="recovery_email" placeholder="<?= lang('placeholder_email'); ?>" required>
            </div>
          </div>
        </div>
        <div class="uk-grid uk-grid-small uk-grid-margin-small" data-uk-grid>
          <div class="uk-width-1-4@m">
            <?php if($this->wowmodule->getreCaptchaStatus() == '1'): ?>
            <div class="uk-margin-small">
              <div class="g-recaptcha" data-sitekey="<?= $recapKey; ?>"></div>
            </div>
            <?php endif; ?>
          </div>
          <div class="uk-width-1-2@m"></div>
          <div class="uk-width-1-4@m">
            <button class="uk-button uk-button-default uk-width-1-1" id="button_recovery" type="submit"><i class="fas fa-paper-plane"></i> <?= lang('button_send'); ?></button>
          </div>
        </div>
        <?= form_close(); ?>
      </div>
    </section>

    <script>
      function RecoveryForm(e) {
        e.preventDefault();

        var restatus = "<?= $this->wowmodule->getreCaptchaStatus(); ?>";

        if(restatus){
          var ren = grecaptcha.getResponse();
          if(ren.length == 0)
          {
            $.amaran({
              'theme': 'awesome error',
              'content': {
                title: '<?= lang('notification_title_error'); ?>',
                message: '<?= lang('notification_captcha_error'); ?>',
                info: '',
                icon: 'fas fa-shield-alt'
              },
              'delay': 5000,
              'position': 'top right',
              'inEffect': 'slideRight',
              'outEffect': 'slideRight'
            });
            return false;
          }
        }

        var username = $('#recovery_username').val();
        var email = $('#recovery_email').val();
        if(username == ''){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= lang('notification_title_error'); ?>',
              message: '<?= lang('notification_username_empty'); ?>',
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
        if(email == ''){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= lang('notification_title_error'); ?>',
              message: '<?= lang('notification_email_empty'); ?>',
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
          url:"<?= base_url($lang.'/forgotpassword'); ?>",
          method:"POST",
          data:{username, email},
          dataType:"text",
          beforeSend: function(){
            $.amaran({
              'theme': 'awesome info',
              'content': {
                title: '<?= lang('notification_title_info'); ?>',
                message: '<?= lang('notification_checking'); ?>',
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

            if (response == 'sendErr') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= lang('notification_title_error'); ?>',
                  message: '<?= lang('notification_check_email'); ?>',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              $('#recoveryForm')[0].reset();
              return false;
            }

            if (response) {
              $.amaran({
                'theme': 'awesome ok',
                'content': {
                  title: '<?= lang('notification_title_success'); ?>',
                  message: '<?= lang('notification_email_sent'); ?>',
                  info: '',
                  icon: 'fas fa-envelope'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#recoveryForm')[0].reset();
            window.location.replace("<?= base_url('login'); ?>");
          }
        });
      }
    </script>
