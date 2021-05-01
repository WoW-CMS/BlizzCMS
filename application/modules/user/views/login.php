<section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
  <div class="uk-background-cover uk-height-small header-section"></div>
</section>
<section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
  <div class="uk-container">
    <h4 class="uk-h4 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-small-bottom"><span><i class="fas fa-sign-in-alt"></i> <?= lang('button_login'); ?></span></h4>
    <?php if ($this->session->flashdata('account_activation') == 'true') : ?>
      <div class="uk-alert-success" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p><i class="far fa-check-circle"></i> <span class="uk-text-bold"><?= lang('notification_valid_key'); ?></span>. <?= lang('notification_valid_key_desc'); ?></p>
      </div>
    <?php elseif ($this->session->flashdata('account_activation') == 'false') : ?>
      <div class="uk-alert-danger" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p><i class="far fa-times-circle"></i> <?= lang('notification_invalid_key'); ?></p>
      </div>
    <?php endif; ?>
    <?= form_open(current_url(), 'id="loginForm" onsubmit="LoginForm(event)"'); ?>
    <div class="uk-margin" uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-inline; delay: 300; repeat: true">
      <div class="uk-form-controls uk-light">
        <div class="uk-inline uk-width-1-1">
          <span class="uk-form-icon"><i class="fas fa-user fa-lg"></i></span>
          <input class="uk-input" name="username" id="login_username" type="text" placeholder="<?= lang('placeholder_username'); ?>">
        </div>
      </div>
    </div>
    <div class="uk-margin" uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-inline; delay: 300; repeat: true">
      <div class="uk-form-controls uk-light">
        <div class="uk-inline uk-width-1-1">
          <span class="uk-form-icon"><i class="fas fa-unlock-alt fa-lg"></i></span>
          <input class="uk-input" name="password" id="login_password" type="password" placeholder="<?= lang('placeholder_password'); ?>">
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
        <a href="<?= base_url('recovery'); ?>" class="uk-button uk-button-text"><i class="fas fa-key"></i> <?= lang('button_forgot_password'); ?></a>
      </div>
      <div class="uk-width-1-2@m"></div>
      <div class="uk-width-1-4@m">
        <button class="uk-button uk-button-default uk-width-1-1" id="button_login" type="submit"><i class="fas fa-sign-in-alt"></i> <?= lang('button_login'); ?></button>
      </div>
    </div>
    <?= form_close(); ?>
  </div>
</section>
<script>
  function LoginForm(e)
  {
    e.preventDefault();

    var reCaptcha = "<?= $this->wowmodule->getreCaptchaStatus(); ?>";
    if (reCaptcha)
    {
      var response = grecaptcha.getResponse();
      if (response.length == 0)
      {
        Swal.fire({
          icon: 'error',
          title: '<?= $this->lang->line('notification_title_error'); ?>',
          text: '<?= $this->lang->line('notification_captcha_error'); ?>',
          showCloseButton: true
        });
        return false;
      }
    }

    var username = $('#login_username').val();
    var password = $('#login_password').val();

    if(username == '')
    {
      Swal.fire({
        icon: 'error',
        title: '<?= $this->lang->line('notification_title_error'); ?>',
        text: '<?= $this->lang->line('notification_username_empty'); ?>',
        showCloseButton: true
      });
      return false;
    }

    if(password == '')
    {
      Swal.fire({
        icon: 'error',
        title: '<?= $this->lang->line('notification_title_error'); ?>',
        text: '<?= $this->lang->line('notification_password_empty'); ?>',
        showCloseButton: true
      });
      return false;
    }

    $.ajax({
      url:"<?= current_url(); ?>",
      method:"post",
      data:{
        username,
        password
      },
      dataType:"text",
      beforeSend: function(){
        Swal.fire({
          icon: 'info',
          title: '<?= $this->lang->line('notification_title_info'); ?>',
          text: '<?= $this->lang->line('notification_checking'); ?>',
          showCloseButton: false,
          showConfirmButton: false,
          timer: 5000
        });
      },
      success:function(response){
        if(!response)
          alert(response);
      }
    });
  }
</script>
