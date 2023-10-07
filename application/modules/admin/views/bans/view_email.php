<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/bans') ?>"><?= lang('bans') ?></a></li>
          <li><a href="<?= site_url('admin/bans/emails') ?>"><?= lang('banned_emails') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('view_ban') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <div class="uk-grid-match uk-child-width-1-3@s uk-margin" uk-grid>
      <div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
            <div class="uk-width-auto">
              <span class="bc-color-lightgray">
                <i class="fa-solid fa-at fa-2x"></i>
              </span>
            </div>
            <div class="uk-width-expand">
              <h6 class="uk-h6 uk-text-uppercase uk-text-bold uk-margin-remove"><?= lang('domain') ?></h6>
              <p class="uk-text-meta uk-margin-remove"><?= $ban->value ?></p>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
            <div class="uk-width-auto">
              <span class="bc-color-lightgray">
                <i class="fa-solid fa-calendar-day fa-2x"></i>
              </span>
            </div>
            <div class="uk-width-expand">
              <h6 class="uk-h6 uk-text-uppercase uk-text-bold uk-margin-remove"><?= lang('start_at') ?></h6>
              <p class="uk-text-meta uk-margin-remove"><?= locate_date($ban->start_at) ?></p>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
            <div class="uk-width-auto">
              <span class="bc-color-lightgray">
                <i class="fa-solid fa-stopwatch fa-2x"></i>
              </span>
            </div>
            <div class="uk-width-expand">
              <h6 class="uk-h6 uk-text-uppercase uk-text-bold uk-margin-remove"><?= lang('end_at') ?></h6>
              <p class="uk-text-meta uk-margin-remove">
                <?php if ($ban->end_at === '0000-00-00 00:00:00'): ?>
                <?= lang('endless') ?>
                <?php else: ?>
                <time datetime="<?= $ban->end_at ?>"><?= locate_date($ban->end_at) ?></time>
                <?php endif ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="uk-card uk-card-default uk-margin">
      <div class="uk-card-header">
        <h6 class="uk-h6 uk-text-uppercase uk-text-bold"><?= lang('reason') ?></h5>
      </div>
      <div class="uk-card-body uk-text-meta uk-text-break">
        <?= html_escape($ban->reason) ?>
      </div>
    </div>
    <a href="<?= site_url('admin/bans/emails') ?>" class="uk-button uk-button-primary"><?= lang('back') ?></a>
  </div>
</section>
