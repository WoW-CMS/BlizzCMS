    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('donate_panel') ?></h4>
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
                <h5 class="uk-h5 uk-text-bold"><i class="far fa-list-alt"></i> <?= lang('menu') ?></h5>
              </div>
              <ul class="uk-nav-default aside-nav uk-nav-parent-icon" uk-nav>
                <li><a href="<?= site_url('user') ?>"><i class="fas fa-user-circle"></i> <?= lang('my_account') ?></a></li>
                <li><a href="<?= site_url('user/settings') ?>"><i class="fas fa-tools"></i> <?= lang('account_settings') ?></a></li>
                <li class="uk-active"><a href="<?= site_url('donate') ?>"><i class="fas fa-hand-holding-usd"></i> <?= lang('donate_panel') ?></a></li>
                <li><a href="<?= site_url('vote') ?>"><i class="fas fa-vote-yea"></i> <?= lang('vote_panel') ?></a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@m">
            <?= $template['partials']['alerts'] ?>
            <?= form_open(site_url('donate/paypal')) ?>
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <div class="uk-grid uk-grid-small uk-flex uk-flex-middle">
                  <div class="uk-width-expand">
                    <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-donate"></i> <?= lang('donate') ?></h5>
                  </div>
                  <div class="uk-width-auto"></div>
                </div>
              </div>
              <div class="uk-card-body">
                <p class="uk-text-small uk-margin-small"><?= lang('paypal_contribution') ?></p>
                <p class="uk-text-small uk-margin-small"><i class="fas fa-info-circle"></i> <?= lang_vars('paypal_exchange_rate', [config_item('paypal_currency_rate'), config_item('paypal_currency'), config_item('paypal_points_rate')]) ?></p>
                <div class="uk-margin-small-bottom uk-light">
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="amount" value="<?= set_value('amount') ?>" placeholder="<?= lang('amount') ?>">
                  </div>
                  <?= form_error('amount', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small-top">
              <button class="uk-button uk-button-default" type="submit"><i class="fab fa-paypal"></i> <?= lang('donate') ?></button>
            </div>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </section>