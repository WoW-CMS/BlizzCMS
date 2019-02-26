    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-small main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <h4 class="uk-h4 uk-heading-line uk-text-uppercase uk-text-bold"><span><i class="fas fa-user-cog"></i> <?= $this->lang->line('nav_reset'); ?></span></h4>
        <div class="uk-margin-small uk-light">
          <div class="uk-form-controls">
            <div class="uk-inline uk-width-1-1">
              <span class="uk-form-icon"><i class="fas fa-user fa-lg"></i></span>
              <input class="uk-input" type="text" id="rec_username" name="rec_username" placeholder="<?= $this->lang->line('form_username'); ?>" required>
            </div>
          </div>
        </div>
        <div class="uk-margin uk-light">
          <div class="uk-form-controls">
            <div class="uk-inline uk-width-1-1">
              <span class="uk-form-icon"><i class="fas fa-envelope fa-lg"></i></span>
              <input class="uk-input" type="email" id="rec_email" name="rec_email" placeholder="<?= $this->lang->line('form_email'); ?>" required>
            </div>
          </div>
        </div>
        <?php if($this->m_modules->getreCaptchaStatus() == '1'): ?>
        <div class="uk-margin">
          <div class="g-recaptcha" data-sitekey="<?= $recapKey; ?>"></div>
        </div>
        <?php endif; ?>
        <button class="uk-button uk-button-default uk-width-1-1 uk-width-1-6@m uk-align-right@m" id="button_reco" name="button_reco"><i class="fas fa-paper-plane"></i> <?= $this->lang->line('button_send'); ?></button>
      </div>
    </section>

    <script>
      $(document).ready(function(){
        $(document).on('click', '#button_reco', function(){
          var restatus = "<?= $this->m_modules->getreCaptchaStatus(); ?>";
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

          var username = $('#rec_username').val();
          var email = $('#rec_email').val();
          if(username == ''){
            $.amaran({
              'theme': 'awesome error',
              'content': {
                title: '<?= $this->lang->line('notify_title_error'); ?>',
                message: '<?= $this->lang->line('notify_username_empty'); ?>',
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
          $.ajax({
            url:"<?= base_url('user/forgotpassword'); ?>",
            method:"POST",
            data:{username, email},
            dataType:"text",
            beforeSend: function(){
              $.amaran({
                'theme': 'awesome info',
                'content': {
                  title: '<?= $this->lang->line('notify_title_info'); ?>',
                  message: '<?= $this->lang->line('notify_checking'); ?>',
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
                    title: '<?= $this->lang->line('notify_title_error'); ?>',
                    message: '<?= $this->lang->line('notify_check_email'); ?>',
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

              if (response) {
                $.amaran({
                  'theme': 'awesome ok',
                  'content': {
                    title: '<?= $this->lang->line('notify_title_success'); ?>',
                    message: '<?= $this->lang->line('notify_email_sent'); ?>',
                    info: '',
                    icon: 'fas fa-envelope'
                  },
                  'delay': 5000,
                  'position': 'top right',
                  'inEffect': 'slideRight',
                  'outEffect': 'slideRight'
                });
              }
              window.location.replace("<?= base_url('login'); ?>");
            }
          });
        });
      });
    </script>
