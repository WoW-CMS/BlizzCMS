    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <h4 class="uk-h4 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-small-bottom"><span><i class="fas fa-user-plus"></i> <?= $this->lang->line('button_register'); ?></span></h4>
        <?= form_open('', 'id="registerForm" onsubmit="RegisterForm(event)"'); ?>
        <div class="uk-margin uk-light">
          <label class="uk-form-label"><?= $this->lang->line('label_login_info'); ?></label>
          <div class="uk-form-controls">
            <div class="uk-inline uk-width-1-1">
              <span class="uk-form-icon"><i class="fas fa-user fa-lg"></i></span>
              <input class="uk-input" type="text" id="register_username" pattern=".{3,}" title="3 characters minimum" placeholder="<?= $this->lang->line('placeholder_username'); ?>" required>
            </div>
          </div>
        </div>
        <div class="uk-margin uk-light">
          <div class="uk-form-controls">
            <div class="uk-inline uk-width-1-1">
              <span class="uk-form-icon"><i class="fas fa-envelope fa-lg"></i></span>
              <input class="uk-input" type="email" id="register_email" placeholder="<?= $this->lang->line('placeholder_email'); ?>" required>
            </div>
          </div>
        </div>
        <div class="uk-margin uk-light">
          <div class="uk-form-controls">
            <div class="uk-inline uk-width-1-1">
              <span class="uk-form-icon"><i class="fas fa-unlock-alt fa-lg"></i></span>
              <input class="uk-input" type="password" id="register_password" pattern=".{5,16}" title="5 characters minimum and maximum 16" placeholder="<?= $this->lang->line('placeholder_password'); ?>" required>
            </div>
          </div>
        </div>
        <div class="uk-margin uk-light">
          <div class="uk-form-controls">
            <div class="uk-inline uk-width-1-1">
              <span class="uk-form-icon"><i class="fas fa-lock fa-lg"></i></span>
              <input class="uk-input" type="password" id="register_repassword" pattern=".{5,16}" title="5 characters minimum and maximum 16" placeholder="<?= $this->lang->line('placeholder_re_password'); ?>" required>
            </div>
          </div>
        </div>
        <div class="uk-grid uk-grid-small uk-grid-margin-small" data-uk-grid>
          <div class="uk-width-1-4@m">
            <?php if ($this->wowmodule->getreCaptchaStatus() == '1') : ?>
              <div class="uk-margin-small">
                <div class="g-recaptcha" data-sitekey="<?= $recapKey; ?>"></div>
              </div>
            <?php endif; ?>
          </div>
          <div class="uk-width-1-2@m"></div>
          <div class="uk-width-1-4@m">
            <button class="uk-button uk-button-default uk-width-1-1" id="button_register" type="submit"><i class="fas fa-user-plus"></i> <?= $this->lang->line('button_register'); ?></button>
          </div>
        </div>
        <?= form_close(); ?>
      </div>
    </section>

    <script>
      function RegisterForm(e) {
        e.preventDefault();

        var restatus = "<?= $this->wowmodule->getreCaptchaStatus(); ?>";

        if (restatus) {
          var ren = grecaptcha.getResponse();

          if (ren.length == 0) {
            Swal.fire({
              icon: 'error',
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              text: '<?= $this->lang->line('notification_captcha_error'); ?>',
              showConfirmButton: true,
            });
            $('#registerForm')[0].reset();
            return false;
          }
        }

        var username = $('#register_username').val();
        var email = $('#register_email').val();
        var password = $('#register_password').val();
        var repassword = $('#register_repassword').val();

        if (username == '') {
          Swal.fire({
            icon: 'error',
            title: '<?= $this->lang->line('notification_title_error'); ?>',
            text: '<?= $this->lang->line('notification_username_empty'); ?>',
            showConfirmButton: true,
          });
          return false;
        }

        if (password == '' || repassword == '') {
          Swal.fire({
            icon: 'error',
            title: '<?= $this->lang->line('notification_title_error'); ?>',
            text: '<?= $this->lang->line('notification_password_empty'); ?>',
            showConfirmButton: true,
          });
          return false;
        }

        $.ajax({
          url: "<?= base_url($lang . '/newacc'); ?>",
          method: "POST",
          data: {
            username,
            email,
            password,
            repassword
          },
          dataType: "text",

          beforeSend: function() {
            Swal.fire({
              icon: 'info',
              title: '<?= $this->lang->line('notification_title_info'); ?>',
              text: '<?= $this->lang->line('notification_checking'); ?>',
              showConfirmButton: false,
              timer: 5000
            });
          },

          success: function(response) {
            if (!response)
              alert(response);

            if (response == 'regUser') {
              Swal.fire({
                icon: 'error',
                title: '<?= $this->lang->line('notification_title_error'); ?>',
                text: '<?= $this->lang->line('notification_account_already_exist'); ?>',
                showConfirmButton: true,
              });
              $('#registerForm')[0].reset();
              return false;
            }

            if (response == 'regEmail') {
              Swal.fire({
                icon: 'error',
                title: '<?= $this->lang->line('notification_title_error'); ?>',
                text: '<?= $this->lang->line('notification_used_email'); ?>',
                showConfirmButton: true,
              });
              $('#registerForm')[0].reset();
              return false;
            }

            if (response == 'regLeng') {
              Swal.fire({
                icon: 'error',
                title: '<?= $this->lang->line('notification_title_error'); ?>',
                text: '<?= $this->lang->line('notification_password_lenght_error'); ?>',
                showConfirmButton: true,
              });
              $('#registerForm')[0].reset();
              return false;
            }

            if (response == 'regPass') {
              Swal.fire({
                icon: 'error',
                title: '<?= $this->lang->line('notification_title_error'); ?>',
                text: '<?= $this->lang->line('notification_password_not_match'); ?>',
                showConfirmButton: true,
              });
              $('#registerForm')[0].reset();
              return false;
            }

            if (response == 'regAct') {
              Swal.fire({
                icon: 'success',
                title: '<?= $this->lang->line('notification_title_success'); ?>',
                text: '<?= $this->lang->line('notification_account_activation'); ?>',
                showConfirmButton: true,
                timer: 50000
              });
              $('#registerForm')[0].reset();
              return true;
            }

            if (response) {
              Swal.fire({
                icon: 'success',
                title: '<?= $this->lang->line('notification_title_success'); ?>',
                text: '<?= $this->lang->line('notification_new_account'); ?>',
                showConfirmButton: true,
                timer: 50000
              });
            }
            $('#registerForm')[0].reset();
            window.location.replace("<?= base_url('login'); ?>");
          }
        });
      }
    </script>
