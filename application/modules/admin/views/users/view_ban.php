    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('view_ban') ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
              <li><a href="<?= site_url('admin/users/banned') ?>"><?= lang('banned_users') ?></a></li>
              <li><span><?= lang('view_ban') ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('admin/users/banned') ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-grid uk-margin-small" data-uk-grid>
          <div class="uk-width-1-3@s">
            <div class="uk-card uk-card-default uk-card-body">
              <div class="uk-flex uk-flex-center uk-margin-small">
                <img class="uk-border-circle uk-box-shadow-medium" src="<?= $template['uploads'].'avatars/'.$this->cms->user_avatar($ban->account) ?>" width="100" height="100" alt="Avatar">
              </div>
              <div class="uk-text-center uk-margin-small">
                <h4 class="uk-h4 uk-margin-remove"><?= $this->cms->user($ban->account, 'username') ?></h4>
                <p class="uk-text-small uk-margin-remove"><?= lang('member_since') ?>: <?= date('j F Y', strtotime($this->cms->user($ban->account, 'joined_at'))) ?></p>
              </div>
            </div>
            <a href="<?= site_url('admin/users/unban/'.$ban->id) ?>" class="uk-button uk-button-danger uk-width-1-1 uk-margin-small"><i class="fas fa-user"></i> <?= lang('unban_user') ?></a>
          </div>
          <div class="uk-width-2-3@s">
            <?= $template['partials']['alerts'] ?>
            <div class="uk-card uk-card-default uk-card-body">
              <dl class="uk-description-list">
                <dt class="uk-text-muted"><?= lang('ban_date') ?>:</dt>
                <dd><i class="fas fa-calendar-day"></i> <?= date('Y-m-d H:i', $ban->bandate) ?></dd>
                <dt class="uk-text-muted"><?= lang('unban_date') ?>:</dt>
                <dd><i class="fas fa-calendar-day"></i> <?= date('Y-m-d H:i', $ban->unbandate) ?></dd>
                <dt class="uk-text-muted"><?= lang('banned_by') ?>:</dt>
                <dd><i class="fas fa-user-edit"></i> <?= html_escape($ban->bannedby) ?></dd>
                <dt class="uk-text-muted"><?= lang('reason') ?>:</dt>
                <dd><i class="fas fa-sticky-note"></i> <?= html_escape($ban->banreason) ?></dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </section>