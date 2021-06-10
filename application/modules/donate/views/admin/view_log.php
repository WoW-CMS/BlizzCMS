    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('view_log') ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
              <li><a href="<?= site_url('donate/admin') ?>"><?= lang('donate') ?></a></li>
              <li><a href="<?= site_url('donate/admin/logs') ?>"><?= lang('logs') ?></a></li></li>
              <li><span><?= lang('view_log') ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('donate/admin/logs') ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-grid uk-margin-small" data-uk-grid>
          <div class="uk-width-1-3@s">
            <div class="uk-card uk-card-default uk-card-body">
              <div class="uk-flex uk-flex-center uk-margin-small">
                <img class="uk-border-circle uk-box-shadow-medium" src="<?= $template['uploads'].'avatars/'.$this->cms->user_avatar($log->user_id) ?>" width="100" height="100" alt="Avatar">
              </div>
              <div class="uk-text-center uk-margin-small">
                <h4 class="uk-h4 uk-margin-remove"><?= $this->cms->user($log->user_id, 'username') ?></h4>
                <p class="uk-text-small uk-margin-remove"><?= lang('member_since') ?>: <?= date('j F Y', strtotime($this->cms->user($log->user_id, 'joined_at'))) ?></p>
              </div>
            </div>
            <a href="<?= site_url('donate/admin/logs/update/'.$log->id) ?>" class="uk-button uk-button-primary uk-width-1-1 uk-margin-small"><i class="fas fa-sync"></i> <?= lang('update_payment') ?></a>
          </div>
          <div class="uk-width-2-3@s">
            <?= $template['partials']['alerts'] ?>
            <div class="uk-card uk-card-default uk-card-body">
              <dl class="uk-description-list">
                <dt class="uk-text-muted"><?= lang('order_id') ?>:</dt>
                <dd><?= $log->order_id ?></dd>
                <dt class="uk-text-muted"><?= lang('reference_id') ?>:</dt>
                <dd><?= $log->reference_id ?></dd>
                <dt class="uk-text-muted"><?= lang('payment_id') ?>:</dt>
                <dd><?= $log->payment_id ?></dd>
                <dt class="uk-text-muted"><?= lang('status') ?>:</dt>
                <dd><?= $log->payment_status ?></dd>
                <dt class="uk-text-muted"><?= lang('gateway') ?>:</dt>
                <dd><?= $log->payment_gateway ?></dd>
                <dt class="uk-text-muted"><?= lang('points') ?>:</dt>
                <dd><?= $log->points ?></dd>
                <dt class="uk-text-muted"><?= lang('amount') ?>:</dt>
                <dd><?= $log->amount ?> <?= $log->currency ?></dd>
                <dt class="uk-text-muted"><?= lang('rewarded') ?>:</dt>
                <dd><?= $log->rewarded ?></dd>
                <dt class="uk-text-muted"><?= lang('ip') ?>:</dt>
                <dd><?= $log->ip ?></dd>
                <dt class="uk-text-muted"><?= lang('creation_date') ?>:</dt>
                <dd><?= $log->created_at ?></dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </section>