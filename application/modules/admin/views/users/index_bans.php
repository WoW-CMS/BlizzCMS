    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-expand@s">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('banned_users'); ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin'); ?>"><?= lang('dashboard'); ?></a></li>
              <li><span><?= lang('banned_users'); ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto@s">
            <div class="uk-grid-small" data-uk-grid>
              <div class="uk-width-expand">
                <?= form_open(site_url('admin/users/banned'), ['method' => 'get']); ?>
                <div class="uk-inline uk-width-1-1">
                  <div class="uk-form-controls">
                    <span class="uk-form-icon"><i class="fas fa-search"></i></span>
                    <input class="uk-input" type="text" name="search" value="<?= $search; ?>" placeholder="<?= lang('search'); ?>">
                  </div>
                </div>
                <?= form_close(); ?>
              </div>
              <div class="uk-width-auto">
                <a href="<?= site_url('admin/users/ban'); ?>" class="uk-button uk-button-primary"><i class="fas fa-gavel fa-lg"></i></a>
              </div>
            </div>
          </div>
        </div>
        <?= $template['partials']['alerts']; ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h4 class="uk-h4"></h4>
          </div>
          <div class="uk-card-body uk-padding-remove">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-table-expand"><?= lang('username'); ?></th>
                  <th class="uk-width-medium uk-visible@s"><?= lang('ban_date'); ?></th>
                  <th class="uk-width-medium uk-visible@s"><?= lang('unban_date'); ?></th>
                  <th class="uk-width-small"><?= lang('ban_by'); ?></th>
                  <th class="uk-width-small"><?= lang('actions'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($bans as $item): ?>
                <tr>
                  <td>
                    <img class="uk-preserve-width uk-border-circle" src="<?= $template['uploads'].'avatars/'.$this->website->user_avatar($item->account); ?>" width="36" height="36" alt="Avatar">
                    <span class="uk-text-middle"><?= $item->username; ?></span>
                  </td>
                  <td class="uk-visible@s"><?= date('Y-m-d H:i', $item->bandate); ?></td>
                  <td class="uk-visible@s"><?= date('Y-m-d H:i', $item->unbandate); ?></td>
                  <td><?= html_escape($item->bannedby); ?></td>
                  <td>
                    <a href="<?= site_url('admin/users/banned/'.$item->id); ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-eye"></i> <?= lang('view'); ?></a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <?= $links; ?>
      </div>
    </section>
