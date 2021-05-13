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
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="far fa-list-alt"></i> <?= lang('menu'); ?></h5>
              </div>
              <ul class="uk-nav-default aside-nav uk-nav-parent-icon" uk-nav>
                <li class="uk-active"><a href="<?= site_url('user'); ?>"><i class="fas fa-user-circle"></i> <?= lang('my_account'); ?></a></li>
                <li><a href="<?= site_url('user/settings') ?>"><i class="fas fa-tools"></i> <?= lang('account_settings'); ?></a></li>
                <li><a href="<?= site_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?= lang('donate_panel'); ?></a></li>
                <li><a href="<?= site_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?= lang('vote_panel'); ?></a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@m">
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="fas fa-info-circle"></i> <?= lang('account_details'); ?></h5>
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
