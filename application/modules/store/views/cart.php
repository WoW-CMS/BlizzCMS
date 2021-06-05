    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('cart') ?></h4>
          </div>
          <div class="uk-width-auto"></div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h5 class="uk-h5 uk-text-bold"><i class="fas fa-shopping-cart"></i> <?= lang('cart') ?></h5>
          </div>
          <div class="uk-card-body">
            <div class="uk-overflow-auto uk-width-1-1 uk-margin-small">
              <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
                <thead>
                  <tr>
                    <th class="uk-width-medium"><?= lang('item') ?></th>
                    <th class="uk-width-medium"><?= lang('character') ?></th>
                    <th class="uk-width-small"><?= lang('price') ?></th>
                    <th><?= lang('quantity') ?></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($contents as $item): ?>
                  <tr>
                    <td><?= $item['name'] ?></td>
                    <td><?= $this->realm->character_name($item['realm'], $item['guid']) ?></td>
                    <td>
                      <?php if ($item['options']['price_type'] === TYPE_DP): ?>
                      <span class="uk-text-small"><i class="dp-icon" uk-tooltip="title: <?= lang('donor_points') ?>"></i><?= $item['dp'] ?></span>
                      <?php elseif ($item['options']['price_type'] === TYPE_VP): ?>
                      <span class="uk-text-small"><i class="vp-icon" uk-tooltip="title: <?= lang('vote_points') ?>"></i><?= $item['vp'] ?></span>
                      <?php elseif ($item['options']['price_type'] === TYPE_AND): ?>
                      <span class="uk-text-small"><i class="dp-icon" uk-tooltip="title: <?= lang('donor_points') ?>"></i><?= $item['dp'] ?> <span class="uk-badge">&amp;</span> <i class="vp-icon" uk-tooltip="title: <?= lang('vote_points') ?>"></i><?= $item['vp'] ?></span>
                      <?php endif ?>
                    </td>
                    <td>
                      <?= form_open(site_url('store/cart/quantity')) ?>
                      <?= form_hidden('id', $item['rowid']) ?>
                      <div class="uk-grid uk-grid-small" data-uk-grid>
                        <div class="uk-width-expand">
                          <div class="uk-form-controls uk-light">
                            <input class="uk-input uk-width-1-1" type="number" name="qty" min="1" value="<?= $item['qty'] ?>">
                          </div>
                        </div>
                        <div class="uk-width-auto">
                          <button class="uk-button uk-button-default uk-margin-small" type="submit" id="button_update"><i class="fas fa-sync"></i></button>
                        </div>
                      </div>
                      <?= form_close() ?>
                    </td>
                    <td>
                      <a href="<?= site_url('store/cart/delete/'.$item['rowid']) ?>" class="uk-button uk-button-danger"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="uk-card-footer">
            <div class="uk-grid uk-grid-small" data-uk-grid>
              <div class="uk-width-expand@s">
                <a href="<?= site_url('store') ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-arrow-circle-left"></i> <?= lang('continue_buying') ?></a>
              </div>
              <div class="uk-width-auto@s uk-flex uk-flex-middle">
                <?php if ($this->cart->total_items()): ?>
                <p class="uk-margin-small uk-text-small"><span class="uk-text-uppercase uk-text-bold">Total:</span> <i class="dp-icon" uk-tooltip="title: <?= lang('donor_points') ?>"></i><?= $this->cart->total_dp() ?> <span class="uk-badge">&amp;</span> <i class="vp-icon" uk-tooltip="title: <?= lang('vote_points') ?>"></i><?= $this->cart->total_vp() ?></p>
                <?php endif ?>
              </div>
              <div class="uk-width-auto@s">
                <?php if ($this->cart->total_items()): ?>
                <a href="<?= site_url('store/cart/checkout') ?>" class="uk-button uk-button-default uk-button-small"><?= lang('checkout') ?> <i class="fas fa-shopping-cart"></i></a>
                <?php endif ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>