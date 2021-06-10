    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('donate') ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
              <li><span><?= lang('donate') ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto"></div>
        </div>
        <div class="uk-card uk-card-default">
          <ul class="uk-subnav" uk-margin>
            <li class="uk-active"><a href="<?= site_url('donate/admin') ?>"><span class="uk-margin-small-right"><i class="fas fa-list-alt"></i></span><?= lang('home') ?></a></li>
            <li><a href="<?= site_url('donate/admin/settings') ?>"><span class="uk-margin-small-right"><i class="fas fa-sliders-h"></i></span><?= lang('settings') ?></a></li>
            <li><a href="<?= site_url('donate/admin/logs') ?>"><span class="uk-margin-small-right"><i class="fas fa-list"></i></span><?= lang('logs') ?></a></li>
          </ul>
        </div>
        <?= $template['partials']['alerts'] ?>
        <div class="uk-grid uk-child-width-1-1 uk-child-width-1-2@s uk-margin-small" data-uk-grid>
          <div>
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><?= lang('latest_donations') ?></h5>
              </div>
              <div class="uk-card-body uk-padding-remove">
                <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-width-small"><?= lang('username') ?></th>
                      <th class="uk-width-small"><?= lang('order_id') ?></th>
                      <th class="uk-width-small"><?= lang('amount') ?></th>
                      <th class="uk-width-small"><?= lang('actions') ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($latest as $item): ?>
                    <tr>
                      <td>
                        <img class="uk-preserve-width uk-border-circle" src="<?= $template['uploads'].'avatars/'.$this->cms->user_avatar($item->user_id) ?>" width="36" height="36" alt="Avatar">
                        <span class="uk-text-middle"><?= $this->cms->user($item->user_id, 'username') ?></span>
                      </td>
                      <td class="uk-text-truncate"><?= $item->order_id ?></td>
                      <td><?= $item->amount ?> <?= $item->currency ?></td>
                      <td><a href="<?= site_url('donate/admin/logs/view/'.$item->id) ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-eye"></i> <?= lang('view') ?></a></td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div>
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="far fa-chart-bar"></i> <?= lang('donation_statistics') ?></h5>
              </div>
              <div class="uk-card-body">
                <canvas id="paypal-chart" data-stats='<?= $this->donation_logs->statistics() ?>'></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
