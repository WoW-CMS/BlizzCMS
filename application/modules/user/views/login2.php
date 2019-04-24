    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <h4 class="uk-h4 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-small-bottom"><span><i class="fas fa-sign-in-alt"></i> <?= $this->lang->line('button_login'); ?></span></h4>
        <?php if($this->session->flashdata('account_activation') == 'true'): ?>
        <div class="uk-alert-success" uk-alert>
          <a class="uk-alert-close" uk-close></a>
          <p><i class="far fa-check-circle"></i> <span class="uk-text-bold"><?= $this->lang->line('notification_valid_key'); ?></span>. <?= $this->lang->line('notification_valid_key_desc'); ?></p>
        </div>
        <?php elseif($this->session->flashdata('account_activation') == 'false'): ?>
        <div class="uk-alert-danger" uk-alert>
          <a class="uk-alert-close" uk-close></a>
          <p><i class="far fa-times-circle"></i> <?= $this->lang->line('notification_invalid_key'); ?></p>
        </div>
        <?php endif; ?>
        <?= form_open('', 'id="loginForm" onsubmit="LoginForm(event)"'); ?>
        <div class="uk-margin" uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-inline; delay: 300; repeat: true">
          <div class="uk-form-controls uk-light">
            <div class="uk-inline uk-width-1-1">
              <span class="uk-form-icon"><i class="fas fa-envelope fa-lg"></i></span>
              <input class="uk-input" id="login_email" type="email" placeholder="<?= $this->lang->line('placeholder_email'); ?>" required>
            </div>
          </div>
        </div>
        <div class="uk-margin" uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-inline; delay: 300; repeat: true">
          <div class="uk-form-controls uk-light">
            <div class="uk-inline uk-width-1-1">
              <span class="uk-form-icon"><i class="fas fa-unlock-alt fa-lg"></i></span>
              <input class="uk-input" id="login_password" type="password" placeholder="<?= $this->lang->line('placeholder_password'); ?>" required>
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
            <a href="<?= base_url('recovery'); ?>" class="uk-button uk-button-text"><i class="fas fa-key"></i> <?= $this->lang->line('button_forgot_password'); ?></a>
          </div>
          <div class="uk-width-1-2@m"></div>
          <div class="uk-width-1-4@m">
            <button class="uk-button uk-button-default uk-width-1-1" id="button_login" type="submit"><i class="fas fa-sign-in-alt"></i> <?= $this->lang->line('button_login'); ?></button>
          </div>
        </div>
        <?= form_close(); ?>
      </div>
    </section>

    <script>
      function LoginForm(e) {
        e.preventDefault();

        var restatus = "<?= $this->wowmodule->getreCaptchaStatus(); ?>";

        if(restatus){
          var ren = grecaptcha.getResponse();
          if(ren.length == 0)
          {
            $.amaran({
              'theme': 'awesome error',
              'content': {
                title: '<?= $this->lang->line('notification_title_error'); ?>',
                message: '<?= $this->lang->line('notification_captcha_error'); ?>',
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

        var email = $('#login_email').val();
        var password = $('#login_password').val();
        if(email == ''){
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
          url:"<?= base_url($lang.'/bnetverify'); ?>",
          method:"POST",
          data:{email, password},
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

            if (response == 'empErr') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('notification_email_error'); ?>',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              $('#loginForm')[0].reset();
              return false;
            }

            if (response) {
              $.amaran({
                'theme': 'awesome ok',
                  'content': {
                  title: '<?= $this->lang->line('notification_title_success'); ?>',
                  message: '<?= $this->lang->line('notification_redirection'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#loginForm')[0].reset();
            window.location.replace("<?= base_url(); ?>");
          }
        });
      }
    </script>
