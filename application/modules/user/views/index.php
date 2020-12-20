    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('user_panel'); ?></h4>
          </div>
          <div class="uk-width-auto"></div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <li class="uk-active"><a href="<?= site_url('user'); ?>"><i class="fas fa-user-circle"></i> <?= lang('tab_account'); ?></a></li>
              <li class="uk-nav-divider"></li>
              <li><a href="<?= site_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?= lang('navbar_donate_panel'); ?></a></li>
              <li><a href="<?= site_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?= lang('navbar_vote_panel'); ?></a></li>
              <li><a href="<?= site_url('store'); ?>"><i class="fas fa-store"></i> <?= lang('tab_store'); ?></a></li>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-header">
                <div class="uk-grid uk-grid-small uk-flex uk-flex-middle">
                  <div class="uk-width-expand@m">
                    <h5 class="uk-h5 uk-text-bold"><i class="fas fa-info-circle"></i> <?= lang('account_details'); ?></h5>
                  </div>
                  <div class="uk-width-auto@m">
                    <a href="<?= site_url('user/settings'); ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-user-edit"></i> <?= lang('account_settings'); ?></a>
                  </div>
                </div>
              </div>
              <div class="uk-card-body">
                <ul class="uk-list uk-list-divider uk-text-small">
                  <li><span class="uk-h5 uk-text-bold uk-margin-small-right"><?= lang('nickname'); ?>:</span> <?= $this->session->userdata('nickname'); ?></li>
                  <li><span class="uk-h5 uk-text-bold uk-margin-small-right"><?= lang('username'); ?>:</span> <?= $this->session->userdata('username'); ?></li>
                  <li><span class="uk-h5 uk-text-bold uk-margin-small-right"><?= lang('email'); ?>:</span> <?= $this->session->userdata('email'); ?></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
