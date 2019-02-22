    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-small main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <h4 class="uk-h4 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-small-bottom"><span><i class="fas fa-sign-in-alt"></i> <?= $this->lang->line('button_login'); ?></span></h4>
        <div class="uk-margin" uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-inline; delay: 300; repeat: true">
          <div class="uk-form-controls uk-light">
            <div class="uk-inline uk-width-1-1">
              <span class="uk-form-icon"><i class="fas fa-envelope fa-lg"></i></span>
              <?= form_input($email_form); ?>
            </div>
          </div>
        </div>
        <div class="uk-margin" uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-inline; delay: 300; repeat: true">
          <div class="uk-form-controls uk-light">
            <div class="uk-inline uk-width-1-1">
              <span class="uk-form-icon"><i class="fas fa-unlock-alt fa-lg"></i></span>
              <?= form_input($password_form); ?>
            </div>
          </div>
        </div>
        <?php if($this->m_modules->getCaptcha() == '1'): ?>
        <div class="uk-margin">
          <div class="g-recaptcha" data-sitekey="<?= $recapKey; ?>"></div>
        </div>
        <?php endif; ?>
        <div class="uk-grid uk-grid-small">
          <div class="uk-width-1-4@m">
            <a href="<?= base_url('recovery') ?>" class="uk-button uk-button-text"><i class="fas fa-key"></i> Forgot your password?</a>
          </div>
          <div class="uk-width-1-2@m"></div>
          <div class="uk-width-1-4@m">
            <button class="uk-button uk-button-default uk-width-1-1 uk-align-right@m" id="button_log" name="button_log"><i class="fas fa-sign-in-alt"></i> <?= $this->lang->line('button_login'); ?></button>
          </div>
        </div>
      </div>
    </section>

    <script>
      $(document).ready(function(){
        $(document).on('click', '#button_log', function(){
          var restatus = "<?= $this->m_modules->getCaptcha(); ?>";
          if(restatus){
            var ren = grecaptcha.getResponse();
            if(ren.length == 0)
            {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notify_title_error'); ?>',
                  message: '<?= $this->lang->line('captcha_error'); ?>',
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
                title: '<?= $this->lang->line('notify_title_error'); ?>',
                message: '<?= $this->lang->line('notify_email_empty'); ?>',
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
                title: '<?= $this->lang->line('notify_title_error'); ?>',
                message: '<?= $this->lang->line('notify_password_empty'); ?>',
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
            url:"<?= base_url('user/verify2'); ?>",
            method:"POST",
            data:{email, password},
            dataType:"text",
            beforeSend: function(){
              $.amaran({
                'theme': 'awesome info',
                'content': {
                  title: '<?= $this->lang->line('notify_title_info'); ?>',
                  message: '<?= $this->lang->line('notify_checking'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
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
                    title: '<?= $this->lang->line('notify_title_error'); ?>',
                    message: '<<?= $this->lang->line('notify_email_error'); ?>',
                    info: '',
                    icon: 'fas fa-exclamation-circle'
                  },
                  'delay': 5000,
                  'position': 'top right',
                  'inEffect': 'slideRight',
                  'outEffect': 'slideRight'
                });
                return false;
              }

              if (response) {
                $.amaran({
                  'theme': 'awesome ok',
                  'content': {
                    title: '<?= $this->lang->line('notify_title_success'); ?>',
                    message: '<?= $this->lang->line('notify_redirection'); ?>',
                    info: '',
                    icon: 'fas fa-check-circle'
                  },
                  'delay': 5000,
                  'position': 'top right',
                  'inEffect': 'slideRight',
                  'outEffect': 'slideRight'
                });
              }
              window.location.replace("<?= base_url(); ?>");
            }
          });
        });
      });
    </script>
