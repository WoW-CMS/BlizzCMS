    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('modules') ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
              <li><span><?= lang('modules') ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('admin/mods/upload') ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-upload"></i> <?= lang('upload') ?></a>
          </div>
        </div>
        <?= $template['partials']['alerts'] ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-list-ul"></i> <?= lang('modules') ?></h5>
          </div>
          <div class="uk-card-body uk-padding-remove">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-width-medium"><?= lang('module') ?></th>
                  <th class="uk-table-expand uk-visible@s"><?= lang('description') ?></th>
                  <th class="uk-width-small uk-visible@s"><?= lang('version') ?></th>
                  <th class="uk-width-small"><?= lang('actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($mods as $key => $mod): ?>
                <tr>
                  <td>
                    <h5 class="uk-text-bold uk-margin-remove"><?= html_escape($mod['name']) ?></h5>
                  </td>
                  <td class="uk-text-small uk-visible@s">
                    <?= html_escape($mod['description']) ?>
                    <p class="uk-text-muted uk-margin-remove"><?= lang('author') ?> <a target="_blank" href="<?= $mod['author_uri'] ?>"><?= html_escape($mod['author']) ?></a></p>
                  </td>
                  <td class="uk-visible@s"><?= html_escape($mod['version']) ?></p></td>
                  <td>
                    <?php if (mod_located($key)): ?>
                    <div class="uk-button-group">
                      <?php if ($mod['panel']): ?>
                      <a href="<?= site_url($key.'/admin') ?>" class="uk-button uk-button-secondary uk-button-small"><i class="fas fa-th-large"></i> <?= lang('view') ?></a>
                      <?php else: ?>
                      <button class="uk-button uk-button-secondary uk-button-small uk-disabled"><i class="fas fa-th-large"></i> <?= lang('view') ?></button>
                      <?php endif ?>
                      <div class="uk-inline">
                        <button class="uk-button uk-button-secondary uk-button-small" type="button"><i class="fas fa-ellipsis-v"></i></button>
                        <div uk-dropdown="mode: click;boundary: ! .uk-container;">
                          <ul class="uk-nav uk-dropdown-nav">
                            <li><a href="<?= site_url('admin/mods/update/'.$key) ?>"><i class="fas fa-sync"></i> <?= lang('update') ?></a></li>
                            <li><a href="<?= site_url('admin/mods/uninstall/'.$key) ?>"><i class="fas fa-undo"></i> <?= lang('uninstall') ?></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <?php else: ?>
                    <div class="uk-button-group">
                      <a href="<?= site_url('admin/mods/install/'.$key) ?>" class="uk-button uk-button-primary uk-button-small"><?= lang('install') ?></a>
                      <div class="uk-inline">
                        <button class="uk-button uk-button-primary uk-button-small" type="button"><i class="fas fa-ellipsis-v"></i></button>
                        <div uk-dropdown="mode: click;boundary: ! .uk-container;">
                          <ul class="uk-nav uk-dropdown-nav">
                            <li><a href="<?= site_url('admin/mods/delete/'.$key) ?>"><i class="fas fa-folder-minus"></i> <?= lang('delete') ?></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <?php endif ?>
                  </td>
                </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>