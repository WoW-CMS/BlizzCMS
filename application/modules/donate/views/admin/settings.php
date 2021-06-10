    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('settings') ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
              <li><a href="<?= site_url('donate/admin') ?>"><?= lang('donate') ?></a></li>
              <li><span><?= lang('settings') ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto"></div>
        </div>
        <div class="uk-card uk-card-default">
          <ul class="uk-subnav" uk-margin>
            <li><a href="<?= site_url('donate/admin') ?>"><span class="uk-margin-small-right"><i class="fas fa-list-alt"></i></span><?= lang('home') ?></a></li>
            <li class="uk-active"><a href="<?= site_url('donate/admin/settings') ?>"><span class="uk-margin-small-right"><i class="fas fa-sliders-h"></i></span><?= lang('settings') ?></a></li>
            <li><a href="<?= site_url('donate/admin/logs') ?>"><span class="uk-margin-small-right"><i class="fas fa-list"></i></span><?= lang('logs') ?></a></li>
          </ul>
        </div>
        <?= $template['partials']['alerts'] ?>
        <?= form_open(current_url()) ?>
        <div class="uk-card uk-card-default uk-margin-small">
          <div class="uk-card-body">
            <div class="uk-margin-small-bottom">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('mode') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="paypal_mode">
                      <option value="" hidden selected><?= lang('select_mode') ?></option>
                      <option value="sandbox" <?php if ('sandbox' === config_item('paypal_mode')) echo 'selected' ?>><?= lang('sandbox') ?></option>
                      <option value="production" <?php if ('production' === config_item('paypal_mode')) echo 'selected' ?>><?= lang('production') ?></option>
                    </select>
                  </div>
                  <?= form_error('paypal_mode', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('minimal_amount') ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-dollar-sign"></i></span>
                      <input class="uk-input" type="text" name="paypal_minimal" value="<?= config_item('paypal_minimal_amount') ?>">
                    </div>
                  </div>
                  <?= form_error('paypal_minimal', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <label class="uk-form-label"><?= lang('client_id') ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fas fa-user"></i></span>
                  <input class="uk-input" type="text" name="paypal_client" value="<?= config_item('paypal_client') ?>">
                </div>
              </div>
              <?= form_error('paypal_client', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-margin-small">
              <label class="uk-form-label"><?= lang('secret') ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fas fa-lock"></i></span>
                  <input class="uk-input" type="text" name="paypal_secret" placeholder="••••••••••••••••••••">
                </div>
              </div>
              <?= form_error('paypal_secret', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom uk-heading-line"><span><?= lang('currency_exchange') ?></span></h5>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-expand">
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-dollar-sign"></i></span>
                      <input class="uk-input" type="text" name="paypal_currency_rate" value="<?= config_item('paypal_currency_rate') ?>">
                    </div>
                  </div>
                  <?= form_error('paypal_currency_rate', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-expand">
                  <div class="uk-form-controls">
                    <select class="uk-select" name="paypal_currency">
                      <option value="" hidden selected><?= lang('select_currency') ?></option>
                      <option value="AUD" <?php if ('AUD' === config_item('paypal_currency')) echo 'selected' ?>>AUD</option>
                      <option value="CAD" <?php if ('CAD' === config_item('paypal_currency')) echo 'selected' ?>>CAD</option>
                      <option value="CZK" <?php if ('CZK' === config_item('paypal_currency')) echo 'selected' ?>>CZK</option>
                      <option value="DKK" <?php if ('DKK' === config_item('paypal_currency')) echo 'selected' ?>>DKK</option>
                      <option value="EUR" <?php if ('EUR' === config_item('paypal_currency')) echo 'selected' ?>>EUR</option>
                      <option value="HKD" <?php if ('HKD' === config_item('paypal_currency')) echo 'selected' ?>>HKD</option>
                      <option value="HUF" <?php if ('HUF' === config_item('paypal_currency')) echo 'selected' ?>>HUF</option>
                      <option value="ILS" <?php if ('ILS' === config_item('paypal_currency')) echo 'selected' ?>>ILS</option>
                      <option value="JPY" <?php if ('JPY' === config_item('paypal_currency')) echo 'selected' ?>>JPY</option>
                      <option value="MXN" <?php if ('MXN' === config_item('paypal_currency')) echo 'selected' ?>>MXN</option>
                      <option value="TWD" <?php if ('TWD' === config_item('paypal_currency')) echo 'selected' ?>>TWD</option>
                      <option value="NZD" <?php if ('NZD' === config_item('paypal_currency')) echo 'selected' ?>>NZD</option>
                      <option value="NOK" <?php if ('NOK' === config_item('paypal_currency')) echo 'selected' ?>>NOK</option>
                      <option value="PHP" <?php if ('PHP' === config_item('paypal_currency')) echo 'selected' ?>>PHP</option>
                      <option value="PLN" <?php if ('PLN' === config_item('paypal_currency')) echo 'selected' ?>>PLN</option>
                      <option value="GBP" <?php if ('GBP' === config_item('paypal_currency')) echo 'selected' ?>>GBP</option>
                      <option value="RUB" <?php if ('RUB' === config_item('paypal_currency')) echo 'selected' ?>>RUB</option>
                      <option value="SGD" <?php if ('SGD' === config_item('paypal_currency')) echo 'selected' ?>>SGD</option>
                      <option value="SEK" <?php if ('SEK' === config_item('paypal_currency')) echo 'selected' ?>>SEK</option>
                      <option value="CHF" <?php if ('CHF' === config_item('paypal_currency')) echo 'selected' ?>>CHF</option>
                      <option value="THB" <?php if ('THB' === config_item('paypal_currency')) echo 'selected' ?>>THB</option>
                      <option value="USD" <?php if ('USD' === config_item('paypal_currency')) echo 'selected' ?>>USD</option>
                    </select>
                  </div>
                  <?= form_error('paypal_currency', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-auto">
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <input class="uk-input" type="text" value="=" disabled>
                    </div>
                  </div>
                </div>
                <div class="uk-width-expand">
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-coins"></i></span>
                      <input class="uk-input" type="text" name="paypal_points_rate" value="<?= config_item('paypal_points_rate') ?>">
                    </div>
                  </div>
                  <?= form_error('paypal_points_rate', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom uk-heading-line"><span><?= lang('option_status') ?></span></h5>
            <div class="uk-grid uk-grid-small uk-flex uk-flex-middle uk-margin-small" data-uk-grid>
              <div class="uk-width-expand">
                <label class="uk-form-label"><i class="fas fa-toggle-off"></i> <?= lang('enable_paypal_donation') ?></label>
                <?= form_error('paypal_gateway', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
              </div>
              <div class="uk-width-auto">
                <label class="uk-switch">
                  <input type="checkbox" name="paypal_gateway" value="true" <?php if ('true' == config_item('paypal_gateway')) echo 'checked' ?>>
                  <div class="uk-switch-slider"></div>
                </label>
              </div>
            </div>
          </div>
        </div>
        <button class="uk-button uk-button-primary uk-margin-small" type="submit"><i class="fas fa-sync"></i> <?= lang('update') ?></button>
        <?= form_close() ?>
      </div>
    </section>