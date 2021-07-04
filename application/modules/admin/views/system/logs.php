    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('system') ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
              <li><a href="<?= site_url('admin/system') ?>"><?= lang('system') ?></a></li>
              <li><span><?= lang('logs') ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto"></div>
        </div>
        <div class="uk-card uk-card-default">
          <ul class="uk-subnav" uk-margin>
            <li><a href="<?= site_url('admin/system') ?>"><span class="uk-margin-small-right"><i class="fas fa-list-alt"></i></span><?= lang('home') ?></a></li>
            <li>
              <a href="#"><span class="uk-margin-small-right"><i class="fas fa-sliders-h"></i></span><?= lang('settings') ?><span uk-icon="icon: triangle-down"></span></a>
              <div uk-dropdown="mode: click;">
                <ul class="uk-nav uk-dropdown-nav">
                  <li><a href="<?= site_url('admin/system/general') ?>"><?= lang('general') ?></a></li>
                  <li><a href="<?= site_url('admin/system/captcha') ?>"><?= lang('captcha') ?></a></li>
                  <li><a href="<?= site_url('admin/system/mail') ?>"><?= lang('mail_smtp') ?></a></li>
                </ul>
              </div>
            </li>
            <li class="uk-active"><a href="<?= site_url('admin/system/logs') ?>"><span class="uk-margin-small-right"><i class="fas fa-list"></i></span><?= lang('logs') ?></a></li>
          </ul>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
              <div class="uk-width-expand@s uk-visible@s">
                <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-list-ul"></i> <?= lang('logs') ?></h5>
              </div>
              <div class="uk-width-auto@s">
                <?= form_open(site_url('admin/system/logs'), ['method' => 'get']) ?>
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
                  <th class="uk-width-small uk-visible@s"><?= lang('type') ?></th>
                  <th class="uk-width-small uk-visible@s"><?= lang('ip') ?></th>
                  <th class="uk-width-medium uk-visible@s"><?= lang('date') ?></th>
                  <th class="uk-table-expand uk-visible@s"><?= lang('message') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($logs as $item): ?>
                <tr>
                  <td>
                    <img class="uk-preserve-width uk-border-circle" src="<?= $template['uploads'].'avatars/'.$this->cms->user_avatar($item->user_id) ?>" width="36" height="36" alt="Avatar">
                    <span class="uk-text-middle"><?= $this->cms->user($item->user_id, 'username') ?></span>
                  </td>
                  <td class="uk-visible@s"><?= $item->type ?></td>
                  <td class="uk-visible@s"><?= $item->ip ?></td>
                  <td class="uk-visible@s"><?= $item->created_at ?></td>
                  <td><?= $item->message ?></td>
                </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
        <?= $links ?>
      </div>
    </section>
