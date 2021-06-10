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
            <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-sync"></i> <?= lang('update_payment') ?></h5>
          </div>
          <div class="uk-card-body">
            <div class="uk-margin-small-bottom">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('username') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" value="<?= $this->cms->user($log->user_id, 'username') ?>" placeholder="<?= lang('username') ?>" disabled>
                  </div>
                  <?= form_error('username', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('order_id') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" type="text" name="order" value="<?= $log->order_id ?>" placeholder="<?= lang('order_id') ?>">
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
                    <input class="uk-input uk-width-1-1" type="text" name="reference" value="<?= $log->reference_id ?>" placeholder="<?= lang('reference_id') ?>">
                  </div>
                  <?= form_error('reference', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('payment_id') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" type="text" name="payment" value="<?= $log->payment_id ?>" placeholder="<?= lang('payment_id') ?>">
                  </div>
                  <?= form_error('payment', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('status') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="status">
                      <option value="" hidden selected><?= lang('select_status') ?></option>
                      <option value="COMPLETED" <?php if ($log->payment_status === 'COMPLETED') echo 'selected' ?>>Completed</option>
                      <option value="PENDING" <?php if ($log->payment_status === 'PENDING') echo 'selected' ?>>Pending</option>
                      <option value="CANCELED" <?php if ($log->payment_status === 'CANCELED') echo 'selected' ?>>Canceled</option>
                    </select>
                  </div>
                  <?= form_error('status', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('gateway') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" disabled>
                      <option value="PayPal" <?php if ($log->payment_gateway === 'PayPal') echo 'selected' ?>>PayPal</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-3@s">
                  <label class="uk-form-label"><?= lang('points') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" type="text" value="<?= $log->points ?>" placeholder="<?= lang('points') ?>" disabled>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-3@s">
                  <label class="uk-form-label"><?= lang('amount') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" type="text" value="<?= $log->amount ?>" placeholder="<?= lang('amount') ?>" disabled>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-3@s">
                  <label class="uk-form-label"><?= lang('currency') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" disabled>
                      <option value="AUD" <?php if ($log->currency === 'AUD') echo 'selected' ?>>AUD</option>
                      <option value="CAD" <?php if ($log->currency === 'CAD') echo 'selected' ?>>CAD</option>
                      <option value="CZK" <?php if ($log->currency === 'CZK') echo 'selected' ?>>CZK</option>
                      <option value="DKK" <?php if ($log->currency === 'DKK') echo 'selected' ?>>DKK</option>
                      <option value="EUR" <?php if ($log->currency === 'EUR') echo 'selected' ?>>EUR</option>
                      <option value="HKD" <?php if ($log->currency === 'HKD') echo 'selected' ?>>HKD</option>
                      <option value="HUF" <?php if ($log->currency === 'HUF') echo 'selected' ?>>HUF</option>
                      <option value="ILS" <?php if ($log->currency === 'ILS') echo 'selected' ?>>ILS</option>
                      <option value="JPY" <?php if ($log->currency === 'JPY') echo 'selected' ?>>JPY</option>
                      <option value="MXN" <?php if ($log->currency === 'MXN') echo 'selected' ?>>MXN</option>
                      <option value="TWD" <?php if ($log->currency === 'TWD') echo 'selected' ?>>TWD</option>
                      <option value="NZD" <?php if ($log->currency === 'NZD') echo 'selected' ?>>NZD</option>
                      <option value="NOK" <?php if ($log->currency === 'NOK') echo 'selected' ?>>NOK</option>
                      <option value="PHP" <?php if ($log->currency === 'PHP') echo 'selected' ?>>PHP</option>
                      <option value="PLN" <?php if ($log->currency === 'PLN') echo 'selected' ?>>PLN</option>
                      <option value="GBP" <?php if ($log->currency === 'GBP') echo 'selected' ?>>GBP</option>
                      <option value="RUB" <?php if ($log->currency === 'RUB') echo 'selected' ?>>RUB</option>
                      <option value="SGD" <?php if ($log->currency === 'SGD') echo 'selected' ?>>SGD</option>
                      <option value="SEK" <?php if ($log->currency === 'SEK') echo 'selected' ?>>SEK</option>
                      <option value="CHF" <?php if ($log->currency === 'CHF') echo 'selected' ?>>CHF</option>
                      <option value="THB" <?php if ($log->currency === 'THB') echo 'selected' ?>>THB</option>
                      <option value="USD" <?php if ($log->currency === 'USD') echo 'selected' ?>>USD</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="uk-button uk-button-primary uk-margin-small" type="submit"><i class="fas fa-plus"></i> <?= lang('create') ?></button>
        <?= form_close() ?>
      </div>
    </section>