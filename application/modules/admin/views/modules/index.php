<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('modules') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <div class="uk-card uk-card-default">
      <div class="uk-card-header">
        <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
          <div class="uk-width-expand">
            <h3 class="uk-card-title"><?= lang('modules') ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('admin/modules/upload') ?>" class="uk-button uk-button-default uk-button-small"><i class="fa-solid fa-upload"></i> <?= lang('upload') ?></a>
          </div>
        </div>
      </div>
      <div class="uk-card-body uk-padding-remove">
        <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
          <thead>
            <tr>
              <th class="uk-table-expand"><?= lang('module') ?></th>
              <th class="uk-width-small uk-visible@s"><?= lang('author') ?></th>
              <th class="uk-width-small uk-visible@s"><?= lang('version') ?></th>
              <th class="uk-width-small"><?= lang('actions') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($modules as $key => $module): ?>
            <tr>
              <td>
                <h5 class="uk-text-bold uk-margin-remove"><?= html_escape($module['name']) ?></h5>
                <p class="uk-text-small uk-margin-remove"><?= html_escape($module['description']) ?></p>
              </td>
              <td class="uk-text-truncate uk-visible@s">
                <a target="_blank" href="<?= $module['author']['website'] ?>" class="uk-button uk-button-text uk-text-truncate"><?= html_escape($module['author']['name']) ?></a>
              </td>
              <td class="uk-visible@s"><?= html_escape($module['version']) ?></td>
              <td>
                <div class="uk-button-group">
                  <?php if ($module['installed']): ?>
                  <?php if (empty($module['dashboard'])): ?>
                  <button class="uk-button uk-button-primary uk-button-small" type="button" disabled><?= lang('dashboard') ?></button>
                  <?php else: ?>
                  <a href="<?= site_url($module['dashboard']) ?>" class="uk-button uk-button-primary uk-button-small"><?= lang('dashboard') ?></a>
                  <?php endif ?>
                  <?php else: ?>
                  <a href="<?= site_url('admin/modules/install/'.$key) ?>" class="uk-button uk-button-primary uk-button-small"><?= lang('install') ?></a>
                  <?php endif ?>
                  <div class="uk-inline">
                    <button class="uk-button uk-button-primary uk-button-small" type="button"><i class="fa-solid fa-caret-down"></i></button>
                    <div uk-dropdown="mode: click; boundary: ! .uk-container">
                      <ul class="uk-nav uk-dropdown-nav">
                        <?php if ($module['installed']): ?>
                        <li><a href="<?= site_url('admin/modules/force/'.$key) ?>"><span class="bc-li-icon"><i class="fa-solid fa-file-import"></i></span><?= lang('force_migrations') ?></a></li>
                        <li><a href="<?= site_url('admin/modules/uninstall/'.$key) ?>"><span class="bc-li-icon"><i class="fa-solid fa-arrow-rotate-left"></i></span><?= lang('uninstall') ?></a></li>
                        <?php else: ?>
                        <li><a href="<?= site_url('admin/modules/delete/'.$key) ?>" class="uk-text-danger"><span class="bc-li-icon"><i class="fa-solid fa-folder-minus"></i></span><?= lang('delete') ?></a></li>
                        <?php endif ?>
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
