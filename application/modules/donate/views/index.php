<?php
if (isset($_POST['donateNow'])):
  $this->donate_model->getDonate($_POST['donateNow']);
endif; ?>

    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-small main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <?php if($this->m_modules->getUCPStatus() == '1'): ?>
              <li><a href="<?= base_url('panel') ?>"><i class="fas fa-user-circle"></i> <?= $this->lang->line('nav_account'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->m_modules->getDonationStatus() == '1'): ?>
              <li class="uk-active"><a href="<?= base_url('donate') ?>"><i class="fas fa-hand-holding-usd"></i> <?=$this->lang->line('button_donate_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->m_modules->getVoteStatus() == '1'): ?>
              <li><a href="<?= base_url('vote') ?>"><i class="fas fa-vote-yea"></i> <?=$this->lang->line('button_vote_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->m_modules->getStoreStatus() == '1'): ?>
              <li><a href="<?= base_url('store') ?>"><i class="fas fa-store"></i> <?=$this->lang->line('nav_store'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->m_modules->getBugtrackerStatus() == '1'): ?>
              <li><a href="<?= base_url('bugtracker') ?>"><i class="fas fa-bug"></i> <?=$this->lang->line('nav_bugtracker'); ?></a></li>
              <?php endif; ?>
              <?php if($this->m_modules->getChangelogsStatus() == '1'): ?>
              <li><a href="<?= base_url('changelogs') ?>"><i class="fas fa-scroll"></i> <?=$this->lang->line('nav_changelogs'); ?></a></li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <div class="uk-heading-divider uk-margin-remove-top uk-margin-small-bottom">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-expand">
                  <span class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fab fa-cc-paypal"></i> <?=$this->lang->line('nav_donate'); ?></span>
                </div>
                <div class="uk-width-auto"></div>
              </div>
            </div>
            <div class="uk-grid-small uk-grid-match uk-child-width-1-1 uk-child-width-1-3@s uk-flex-center" uk-grid>
              <?php foreach($this->donate_model->getDonations()->result() as $donateList): ?>
              <div>
                <div class="uk-transition-toggle" tabindex="0">
                  <div class="uk-card uk-card-body uk-card-donate uk-text-center uk-transition-scale-up uk-transition-opaque">
                    <i class="fab fa-paypal fa-3x"></i>
                    <h2 class="uk-margin-small uk-text-bold"><?= $donateList->name ?><br>
                      <sup><?= $this->config->item('currencySymbol'); ?></sup><?= $donateList->price ?>
                    </h2>
                    <h5 class="uk-margin-small"><span uk-icon="icon: plus-circle"></span> Get <span class="uk-text-bold"><?= $donateList->points ?></span> <?= $this->lang->line('panel_dp') ?>
                    </h5>
                    <form action="" method="post" accept-charset="utf-8">
                      <div class="uk-margin">
                        <button class="uk-button uk-button-secondary" type="submit" value="<?= $donateList->id ?>" name="donateNow"><i class="fas fa-donate"></i> <?= $this->lang->line('button_donate'); ?></button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
