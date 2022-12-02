<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('bans') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <div class="uk-margin" uk-grid>
      <div class="uk-width-1-3@s uk-width-1-4@m">
        <div class="uk-card uk-card-default">
          <ul class="uk-nav-default" uk-nav>
            <li class="uk-nav-header"><?= lang('types') ?></li>
            <li class="uk-active"><a href="<?= site_url('admin/bans') ?>"><?= lang('banned_users') ?></a></li>
            <li><a href="<?= site_url('admin/bans/emails') ?>"><?= lang('banned_emails') ?></a></li>
            <li><a href="<?= site_url('admin/bans/ips') ?>"><?= lang('banned_ips') ?></a></li>
          </ul>
        </div>
      </div>
      <div class="uk-width-expand@s">
        <?= $template['partials']['alerts'] ?>
        <div class="uk-card uk-card-default uk-margin">
          <div class="uk-card-header">
            <div class="uk-grid-small uk-margin-small uk-flex uk-flex-middle" uk-grid>
              <div class="uk-width-expand">
                <h3 class="uk-card-title"><?= lang('banned_users') ?></h3>
              </div>
              <div class="uk-width-auto">
                <div class="uk-button-group">
                  <button href="#filter_toggle" class="uk-button uk-button-default uk-button-small" type="button" uk-toggle="target: #filter_toggle; animation: uk-animation-slide-top-small"><i class="fa-solid fa-filter"></i></button>
                  <div class="uk-inline uk-margin-small-left">
                    <button class="uk-button uk-button-default uk-button-small" type="button"><i class="fa-solid fa-gavel"></i></button>
                    <div uk-dropdown="mode: click; boundary: ! .uk-container">
                      <ul class="uk-nav uk-dropdown-nav">
                        <li><a href="<?= site_url('admin/bans/add') ?>"><span class="bc-li-icon"><i class="fa-solid fa-circle-plus"></i></span><?= lang('add_ban') ?></a></li>
                        <li><a href="<?= site_url('admin/bans/delete') ?>"><span class="bc-li-icon"><i class="fa-solid fa-circle-minus"></i></span><?= lang('delete_ban') ?></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="uk-card-body uk-padding-remove">
            <div id="filter_toggle" class="uk-padding-small" hidden>
              <h6 class="uk-h6 uk-text-bold uk-text-uppercase uk-margin-small"><i class="fa-solid fa-filter fa-lg"></i> <?= lang('filter') ?></h6>
              <form action="<?= current_url() ?>" method="get" accept-charset="utf-8">
                <div class="uk-grid-small" uk-grid>
                  <div class="uk-width-expand@s">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                      <input class="uk-input" type="text" name="search" value="<?= $search ?>" placeholder="<?= lang('search') ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="uk-width-auto@s">
                    <button class="uk-button uk-button-primary" type="submit"><?= lang('search') ?></button>
                  </div>
                </div>
              </form>
            </div>
            <div class="uk-overflow-auto">
              <table class="uk-table uk-table-middle uk-table-divider uk-table-small uk-margin-remove">
                <thead>
                  <tr>
                    <th class="uk-table-expand"><?= lang('username') ?></th>
                    <th class="uk-width-medium"><?= lang('end_at') ?></th>
                    <th class="uk-width-small"><?= lang('actions') ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($bans as $item): ?>
                  <tr>
                    <td>
                      <img class="uk-preserve-width uk-border-circle bc-margin-xsmall-right" src="<?= user_avatar($item->value) ?>" width="32" height="32" alt="<?= lang('avatar') ?>">
                      <span class="uk-text-middle"><?= $item->username ?></span>
                    </td>
                    <td><?= $item->end_at === '0000-00-00 00:00:00' ? lang('endless') : $item->end_at ?></td>
                    <td>
                      <div class="uk-button-group">
                        <a href="<?= site_url('admin/bans/view/'.$item->id) ?>" class="uk-button uk-button-primary uk-button-small"><?= lang('view') ?></a>
                        <div class="uk-inline">
                          <button class="uk-button uk-button-primary uk-button-small" type="button"><i class="fa-solid fa-caret-down"></i></button>
                          <div uk-dropdown="mode: click; boundary: ! .uk-container">
                            <ul class="uk-nav uk-dropdown-nav">
                              <li><a href="<?= site_url('admin/bans/delete?user='.$item->username) ?>"><span class="bc-li-icon"><i class="fa-solid fa-trash-can"></i></span><?= lang('delete') ?></a></li>
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
        <?= $pagination ?>
      </div>
    </div>
  </div>
</section>
