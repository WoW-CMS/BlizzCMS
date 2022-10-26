<?php
if (isset($_POST['changePriory'])):
  $value = $_POST['prioryValue'];
  $this->bugtracker_model->changePriority($idlink, $value);
endif;

if (isset($_POST['changeStatus'])):
  $value = $_POST['StatusValue'];
  $this->bugtracker_model->changeStatus($idlink, $value);
endif;

if (isset($_POST['changetypes'])):
  $value = $_POST['typesValue'];
  $this->bugtracker_model->changeType($idlink, $value);
endif;

if (isset($_POST['btn_closeBugtracker'])):
  $this->bugtracker_model->closeIssue($idlink);
endif; ?>

    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <?php if($this->wowmodule->getStatusModule('User Panel') == '1'): ?>
              <li><a href="<?= base_url('panel'); ?>"><i class="fas fa-user-circle"></i> <?= $this->lang->line('tab_account'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->wowmodule->getStatusModule('Donation') == '1'): ?>
              <li><a href="<?= base_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?=$this->lang->line('navbar_donate_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getStatusModule('Vote') == '1'): ?>
              <li><a href="<?= base_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?=$this->lang->line('navbar_vote_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getStatusModule('Store') == '1'): ?>
              <li><a href="<?= base_url('store'); ?>"><i class="fas fa-store"></i> <?=$this->lang->line('tab_store'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->wowmodule->getStatusModule('Bugtracker') == '1'): ?>
              <li class="uk-active"><a href="<?= base_url('bugtracker'); ?>"><i class="fas fa-bug"></i> <?=$this->lang->line('tab_bugtracker'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getStatusModule('Changelogs') == '1'): ?>
              <li><a href="<?= base_url('changelogs'); ?>"><i class="fas fa-scroll"></i> <?=$this->lang->line('tab_changelogs'); ?></a></li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-header">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-width-expand@s">
                    <h5 class="uk-h5 uk-text-bold"><i class="fas fa-bug"></i> <?= $this->bugtracker_model->getTitleIssue($idlink); ?></h5>
                  </div>
                  <div class="uk-width-auto@s">
                    <p class="uk-text-small"><i class="far fa-clock"></i> <?= date('F j, Y, h:i a', $this->bugtracker_model->getDate($idlink)); ?></p>
                  </div>
                </div>
              </div>
              <div class="uk-card-body">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-width-3-4@s">
                    <?= $this->bugtracker_model->getDescIssue($idlink); ?>
                  </div>
                  <div class="uk-width-1-4@s">
                    <ul class="uk-list uk-text-small">
                      <li><i class="far fa-user-circle"></i> <?= $this->lang->line('table_header_author'); ?>: <?= $this->wowauth->getUsernameID($this->bugtracker_model->getAuthor($idlink)); ?></li>
                      <li><i class="fas fa-list"></i> <?= $this->lang->line('placeholder_type'); ?>: <span class="uk-label"><?= $this->bugtracker_model->getType($this->bugtracker_model->getTypeID($idlink)); ?></span></li>
                      <li><i class="fas fa-exclamation-circle"></i> <?= $this->lang->line('table_header_priority'); ?>: <span class="uk-label uk-label-danger"><?= $this->bugtracker_model->getPriority($this->bugtracker_model->getPriorityID($idlink)); ?></span></li>
                      <li><i class="fas fa-tags"></i> <?= $this->lang->line('table_header_status'); ?>: <span class="uk-label uk-label-success"><?= $this->bugtracker_model->getStatus($this->bugtracker_model->getStatusID($idlink)); ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <?php if($this->wowauth->getRank($this->session->userdata('wow_sess_id')) > 0): ?>
            <div class="uk-grid uk-grid-small uk-grid-divider uk-child-width-1-1 uk-child-width-1-3@m uk-margin-small" data-uk-grid>
              <div>
                <form method="post" action="">
                  <div class="uk-margin uk-light">
                    <div class="uk-form-controls">
                      <select class="uk-select uk-width-1-1" id="form-stacked-select" name="prioryValue">
                        <?php foreach($this->bugtracker_model->getPriorityGeneral()->result() as $priory): ?>
                        <option value="<?= $priory->id ?>"><?= $priory->title ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="uk-margin-small">
                    <button class="uk-button uk-button-default uk-width-1-1" type="submit" name="changePriory"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_save_changes'); ?></button>
                  </div>
                </form>
              </div>
              <div>
                <form method="post" action="">
                  <div class="uk-margin uk-light">
                    <div class="uk-form-controls">
                      <select class="uk-select uk-width-1-1" id="form-stacked-select" name="StatusValue">
                        <?php foreach($this->bugtracker_model->getStatusGeneral()->result() as $priory): ?>
                        <option value="<?= $priory->id ?>"><?= $priory->title ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="uk-margin-small">
                    <button class="uk-button uk-button-default uk-width-1-1" type="submit" name="changeStatus"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_save_changes'); ?></button>
                  </div>
                </form>
              </div>
              <div>
                <form method="post" action="">
                  <div class="uk-margin uk-light">
                    <div class="uk-form-controls">
                      <select class="uk-select uk-width-1-1" id="form-stacked-select" name="typesValue">
                        <?php foreach($this->bugtracker_model->getTypesGeneral()->result() as $priory): ?>
                        <option value="<?= $priory->id ?>"><?= $priory->title ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="uk-margin-small">
                    <button class="uk-button uk-button-default uk-width-1-1" type="submit" name="changetypes"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_save_changes'); ?></button>
                  </div>
                </form>
              </div>
            </div>
            <div>
              <div class="uk-margin-small">
                <form method="post" action="">
                  <button type="submit" name="btn_closeBugtracker" class="uk-button uk-button-danger uk-width-1-1"><i class="fas fa-times-circle"></i> <?= $this->lang->line('button_close'); ?></button>
                </form>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
