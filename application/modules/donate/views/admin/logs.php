    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-expand@s">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('logs') ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
              <li><a href="<?= site_url('donate/admin') ?>"><?= lang('donate') ?></a></li>
              <li><span><?= lang('logs') ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto@s">
            <a href="<?= site_url('donate/admin/logs/create') ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-pen"></i> <?= lang('manual_payment') ?></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <ul class="uk-subnav" uk-margin>
            <li><a href="<?= site_url('donate/admin') ?>"><span class="uk-margin-small-right"><i class="fas fa-list-alt"></i></span><?= lang('home') ?></a></li>
            <li><a href="<?= site_url('donate/admin/settings') ?>"><span class="uk-margin-small-right"><i class="fas fa-sliders-h"></i></span><?= lang('settings') ?></a></li>
            <li class="uk-active"><a href="<?= site_url('donate/admin/logs') ?>"><span class="uk-margin-small-right"><i class="fas fa-list"></i></span><?= lang('logs') ?></a></li>
          </ul>
        </div>
        <?= $template['partials']['alerts'] ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
              <div class="uk-width-expand@s uk-visible@s">
                <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-list-ul"></i> <?= lang('logs') ?></h5>
              </div>
              <div class="uk-width-auto@s">
                <?= form_open(site_url('donate/admin/logs'), ['method' => 'get']) ?>
                <div class="uk-grid-small" data-uk-grid>
                  <div class="uk-width-expand">
                    <div class="uk-inline uk-width-1-1">
                      <div class="uk-form-controls">
                        <span class="uk-form-icon"><i class="fas fa-search"></i></span>
                        <input class="uk-input uk-form-small" type="text" name="search" value="<?= $search ?>" placeholder="<?= lang('search') ?>">
                      </div>
                    </div>
                  </div>
                  <div class="uk-width-auto">
                    <button class="uk-button uk-button-primary uk-button-small" type="submit"><i class="fas fa-search"></i></button>
                  </div>
                </div>
                <?= form_close() ?>
              </div>
            </div>
          </div>
          <div class="uk-card-body uk-padding-remove">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-table-expand"><?= lang('username') ?></th>
                  <th class="uk-width-medium uk-visible@s"><?= lang('order_id') ?></th>
                  <th class="uk-width-small uk-visible@s"><?= lang('status') ?></th>
                  <th class="uk-width-small"><?= lang('amount') ?></th>
                  <th class="uk-width-small uk-visible@s"><?= lang('rewarded') ?></th>
                  <th class="uk-width-small uk-visible@s"><?= lang('date') ?></th>
                  <th class="uk-width-small"><?= lang('actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($logs as $item): ?>
                <tr>
                  <td>
                    <img class="uk-preserve-width uk-border-circle" src="<?= $template['uploads'].'avatars/'.$this->cms->user_avatar($item->user_id) ?>" width="36" height="36" alt="Avatar">
                    <span class="uk-text-middle"><?= $this->cms->user($item->user_id, 'username') ?></span>
                  </td>
                  <td class="uk-visible@s"><?= $item->order_id ?></td>
                  <td class="uk-visible@s"><?= $item->payment_status ?></td>
                  <td><?= $item->amount ?> <?= $item->currency ?></td>
                  <td class="uk-visible@s"><?= $item->rewarded ?></td>
                  <td class="uk-visible@s"><?= $item->created_at ?></td>
                  <td>
                    <div class="uk-button-group">
                      <a href="<?= site_url('donate/admin/logs/view/'.$item->id) ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-eye"></i> <?= lang('view') ?></a>
                      <div class="uk-inline">
                        <button class="uk-button uk-button-primary uk-button-small" type="button"><i class="fas fa-ellipsis-v"></i></button>
                        <div uk-dropdown="mode: click;boundary: ! .uk-container;">
                          <ul class="uk-nav uk-dropdown-nav">
                            <li><a href="<?= site_url('donate/admin/logs/update/'.$item->id) ?>"><i class="fas fa-sync"></i> <?= lang('update_payment') ?></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
