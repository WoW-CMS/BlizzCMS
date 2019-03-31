<?php
if (isset($_POST['button_changeavatar'])):
  $valueAvatar = $_POST['radioAvatars'];
  $this->user_model->insertAvatar($valueAvatar);
endif;

if (isset($_POST['button_uppdateinfo'])):
  $user = $this->session->userdata('fx_sess_username');
  $mail = $this->session->userdata('fx_sess_email');
  $id = $this->session->userdata('fx_sess_id');

  $this->user_model->updateInformation($id, $user, $mail);
endif; ?>

    <div id="avatars" uk-modal="bg-close: false">
      <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
          <h2 class="uk-modal-title uk-text-uppercase"><i class="fas fa-camera"></i> <?= $this->lang->line('button_change_avatar'); ?></h2>
        </div>
        <form action="" method="post" accept-charset="utf-8">
          <div class="uk-modal-body">
            <div class="uk-margin">
              <div class="uk-form-controls">
                <div class="uk-grid uk-grid-medium uk-child-width-1-3 uk-child-width-1-4@s uk-child-width-1-5@m uk-flex-center uk-text-center">
                  <?php foreach($this->user_model->getAllAvatars()->result() as $allAvts): ?>
                    <div>
                      <img class="uk-border-rounded" src="<?= base_url('includes/images/profiles/'.$allAvts->name); ?>" width="100" height="100">
                      <input class="uk-radio" type="radio" name="radioAvatars" value="<?= $allAvts->id ?>" checked>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="uk-modal-footer uk-text-right actions">
            <button class="uk-button uk-button-danger uk-modal-close" type="button"><i class="fas fa-times-circle"></i> <?= $this->lang->line('button_cancel'); ?></button>
            <button class="uk-button uk-button-default" type="submit" name="button_changeavatar"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_change'); ?></button>
          </div>
        </form>
      </div>
    </div>

    <div id="personalinfo" uk-modal="bg-close: false">
      <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
          <h2 class="uk-modal-title uk-text-uppercase"><i class="far fa-user"></i> <?= $this->lang->line('button_add_personal_info'); ?></h2>
        </div>
        <form action="" method="post" accept-charset="utf-8">
          <div class="uk-modal-body">
            <div class="uk-margin uk-light">
              <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_username'); ?> & <?= $this->lang->line('placeholder_email'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fas fa-user fa-lg"></i></span>
                  <input class="uk-input uk-width-1-1" type="text" placeholder="<?= $this->session->userdata('fx_sess_username'); ?>" disabled>
                </div>
              </div>
            </div>
            <div class="uk-margin uk-light">
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fas fa-envelope fa-lg"></i></span>
                  <input class="uk-input" type="text" placeholder="<?= $this->session->userdata('fx_sess_email'); ?>" disabled>
                </div>
              </div>
            </div>
          </div>
          <div class="uk-modal-footer uk-text-right actions">
            <button class="uk-button uk-button-danger uk-modal-close" type="button"><i class="fas fa-times-circle"></i> <?= $this->lang->line('button_cancel'); ?></button>
            <button class="uk-button uk-button-default" type="submit" name="button_uppdateinfo"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_change'); ?></button>
          </div>
        </form>
      </div>
    </div>
