<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('update') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <div class="uk-margin-remove-top" uk-grid>
      <div class="uk-width-2-5@s uk-width-1-3@m uk-flex-last uk-flex-first@s">
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h3 class="uk-card-title"><i class="fa-solid fa-wave-square"></i> <?= lang('versions') ?></h3>
          </div>
          <ul class="uk-list uk-list-striped uk-margin-remove">
            <?php if (isset($versions) && ! empty($versions)): ?>
            <?php foreach ($versions as $item): ?>
            <li>
              <a target="_blank" href="<?= $item->link ?>" class="uk-button uk-button-text"><?= html_escape($item->name) ?></a>
              <p class="uk-text-meta uk-margin-remove"><i class="fa-solid fa-calendar-day"></i> <time datetime="<?= format_date($item->date, 'c') ?>"><?= format_date($item->date, 'M j, Y, h:i A') ?></time></p>
            </li>
            <?php endforeach ?>
            <?php else: ?>
            <li><span class="uk-text-emphasis"><i class="fa-solid fa-file-circle-exclamation"></i></span> <?= lang('wowcms_versions_empty') ?></li>
            <?php endif ?>
          </ul>
        </div>
      </div>
      <div class="uk-width-3-5@s uk-width-2-3@m uk-flex-first uk-flex-last@s">
        <div class="uk-card uk-card-default uk-card-body bc-card-update">
          <div uk-grid>
            <div class="uk-width-2-3 uk-width-1-2@m">
              <h2 class="bc-logo uk-margin-remove">BlizzCMS</h2>
              <p class="uk-h4 uk-margin-remove"><?= $latest_version ?></p>
              <p class="uk-text-small uk-margin-remove"><i class="fa-solid fa-code-commit"></i> <?= lang('version') ?></p>
              <?php if (version_compare($latest_version, config_item('cms_version'), '<=')): ?>
              <button class="uk-button uk-button-default uk-margin-small" type="button" disabled><i class="fa-solid fa-spinner"></i> <?= lang('update') ?></button>
              <?php else: ?>
              <a href="<?= site_url('admin/update/run') ?>" class="uk-button uk-button-primary uk-margin-small"><i class="fa-solid fa-rocket"></i> <?= lang('update') ?></a>
              <?php endif ?>
              <p class="uk-text-small uk-margin-small"><span class="uk-text-danger"><i class="fa-solid fa-note-sticky"></i></span> <?= lang('update_note') ?></p>
            </div>
            <div class="uk-width-1-3 uk-width-1-2@m"></div>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-card-body uk-margin">
          <div uk-grid>
            <div class="uk-width-expand">
              <h5 class="uk-h5 uk-text-bold uk-margin-remove"><?= lang('force_migrations') ?></h5>
              <p class="uk-text-small uk-margin-remove"><span class="uk-text-danger"><i class="fa-solid fa-circle-exclamation"></i></span> <?= lang('force_migrations_note') ?></p>
            </div>
            <div class="uk-width-auto">
              <a href="<?= site_url('admin/update/force') ?>" class="uk-button uk-button-primary uk-button-small"><i class="fa-solid fa-file-import"></i> <?= lang('force') ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
