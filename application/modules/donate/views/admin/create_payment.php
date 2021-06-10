    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('logs') ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
              <li><a href="<?= site_url('donate/admin') ?>"><?= lang('donate') ?></a></li>
              <li><a href="<?= site_url('donate/admin/logs') ?>"><?= lang('logs') ?></a></li>
            </ul>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('donate/admin/logs') ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <?= $template['partials']['alerts'] ?>
        <?= form_open(current_url()) ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-pen"></i> <?= lang('create_manual_payment') ?></h5>
          </div>
          <div class="uk-card-body">
            <div class="uk-margin-small-bottom">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('username') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="username" value="<?= set_value('username') ?>" placeholder="<?= lang('username') ?>">
                  </div>
                  <?= form_error('username', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('order_id') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" type="text" name="order" value="<?= set_value('order') ?>" placeholder="<?= lang('order_id') ?>">
                  </div>
                  <?= form_error('order', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('reference_id') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" type="text" name="reference" value="<?= set_value('reference') ?>" placeholder="<?= lang('reference_id') ?>">
                  </div>
                  <?= form_error('reference', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('payment_id') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" type="text" name="payment" value="<?= set_value('payment') ?>" placeholder="<?= lang('payment_id') ?>">
                  </div>
                  <?= form_error('payment', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('gateway') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="gateway">
                      <option value="" hidden selected><?= lang('select_gateway') ?></option>
                      <option value="PayPal" <?= set_select('gateway', 'PayPal') ?>>PayPal</option>
                    </select>
                  </div>
                  <?= form_error('gateway', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('points') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" type="text" name="points" value="<?= set_value('points') ?>" placeholder="<?= lang('points') ?>">
                  </div>
                  <?= form_error('points', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('amount') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" type="text" name="amount" value="<?= set_value('amount') ?>" placeholder="<?= lang('amount') ?>">
                  </div>
                  <?= form_error('amount', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('currency') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="currency">
                      <option value="" hidden selected><?= lang('select_currency') ?></option>
                      <option value="AUD" <?= set_select('currency', 'AUD') ?>>AUD</option>
                      <option value="CAD" <?= set_select('currency', 'CAD') ?>>CAD</option>
                      <option value="CZK" <?= set_select('currency', 'CZK') ?>>CZK</option>
                      <option value="DKK" <?= set_select('currency', 'DKK') ?>>DKK</option>
                      <option value="EUR" <?= set_select('currency', 'EUR') ?>>EUR</option>
                      <option value="HKD" <?= set_select('currency', 'HKD') ?>>HKD</option>
                      <option value="HUF" <?= set_select('currency', 'HUF') ?>>HUF</option>
                      <option value="ILS" <?= set_select('currency', 'ILS') ?>>ILS</option>
                      <option value="JPY" <?= set_select('currency', 'JPY') ?>>JPY</option>
                      <option value="MXN" <?= set_select('currency', 'MXN') ?>>MXN</option>
                      <option value="TWD" <?= set_select('currency', 'TWD') ?>>TWD</option>
                      <option value="NZD" <?= set_select('currency', 'NZD') ?>>NZD</option>
                      <option value="NOK" <?= set_select('currency', 'NOK') ?>>NOK</option>
                      <option value="PHP" <?= set_select('currency', 'PHP') ?>>PHP</option>
                      <option value="PLN" <?= set_select('currency', 'PLN') ?>>PLN</option>
                      <option value="GBP" <?= set_select('currency', 'GBP') ?>>GBP</option>
                      <option value="RUB" <?= set_select('currency', 'RUB') ?>>RUB</option>
                      <option value="SGD" <?= set_select('currency', 'SGD') ?>>SGD</option>
                      <option value="SEK" <?= set_select('currency', 'SEK') ?>>SEK</option>
                      <option value="CHF" <?= set_select('currency', 'CHF') ?>>CHF</option>
                      <option value="THB" <?= set_select('currency', 'THB') ?>>THB</option>
                      <option value="USD" <?= set_select('currency', 'USD') ?>>USD</option>
                    </select>
                  </div>
                  <?= form_error('currency', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="uk-button uk-button-primary uk-margin-small" type="submit"><i class="fas fa-plus"></i> <?= lang('create') ?></button>
        <?= form_close() ?>
      </div>
    </section>