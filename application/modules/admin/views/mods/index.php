    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('manage_modules'); ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin'); ?>"><?= lang('dashboard'); ?></a></li>
              <li><span><?= lang('manage_modules'); ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto"></div>
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
                  <th class="uk-table-expand"><?= lang('module'); ?></th>
                  <th class="uk-width-small"><?= lang('actions'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($mods as $key => $mod): ?>
                <tr>
                  <td>
                    <h5 class="uk-text-bold uk-margin-remove"><?= html_escape($mod['name']); ?></h5>
                    <p class="uk-text-small uk-text-muted uk-margin-remove"><?= html_escape($mod['description']); ?></p>
                    <p class="uk-text-small uk-text-muted uk-margin-remove"><?= lang('author'); ?> <a target="_blank" href="<?= $mod['website']; ?>"><?= html_escape($mod['author']); ?></a></p>
                  </td>
                  <td>
                    <?php if (mod_located($key)): ?>
                    <div class="uk-button-group">
                      <?php if ($mod['panel']['enabled']): ?>
                      <a href="<?= site_url($mod['panel']['route']); ?>" class="uk-button uk-button-secondary uk-button-small"><i class="fas fa-cogs"></i> Panel</a>
                      <?php else: ?>
                      <button class="uk-button uk-button-secondary uk-button-small" type="button"><i class="fas fa-cogs"></i> Panel</button>
                      <?php endif; ?>
                      <div class="uk-inline">
                        <button class="uk-button uk-button-secondary uk-button-small" type="button"><i class="fas fa-ellipsis-v"></i></button>
                        <div uk-dropdown="mode: click;boundary: ! .uk-container;">
                          <ul class="uk-nav uk-dropdown-nav">
                            <li><a href="<?= site_url('admin/mods/uninstall/'.$key); ?>"><i class="fas fa-folder-minus"></i> <?= lang('uninstall'); ?></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <?php else: ?>
                    <a href="<?= site_url('admin/mods/install/'.$key); ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-cog"></i> <?= lang('install'); ?></a>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>