<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><span><?= lang('dashboard') ?></span></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('dashboard') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <div class="uk-grid-match uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m uk-margin" uk-grid>
      <div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-grid-small" uk-grid>
            <div class="uk-width-auto">
              <span class="fa-stack bc-stack-medium">
                <span class="bc-color-blue bc-icon-drop-shadow">
                  <i class="fa-solid fa-circle fa-stack-2x"></i>
                </span>
                <i class="fa-solid fa-user-group fa-stack-1x fa-inverse"></i>
              </span>
            </div>
            <div class="uk-width-expand">
              <h3 class="uk-h3 uk-text-bold uk-margin-remove"><span class="purecounter" data-purecounter-start="0" data-purecounter-end="<?= $total_users ?>" data-purecounter-separator="true">0</span></h3>
              <p class="uk-text-meta uk-margin-remove"><?= lang('registered_users') ?></p>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-grid-small" uk-grid>
            <div class="uk-width-auto">
              <span class="fa-stack bc-stack-medium">
                <span class="bc-color-pink bc-icon-drop-shadow">
                  <i class="fa-solid fa-circle fa-stack-2x"></i>
                </span>
                <i class="fa-solid fa-user-slash fa-stack-1x fa-inverse"></i>
              </span>
            </div>
            <div class="uk-width-expand">
              <h3 class="uk-h3 uk-text-bold uk-margin-remove"><span class="purecounter" data-purecounter-start="0" data-purecounter-end="<?= $total_bans ?>" data-purecounter-separator="true">0</span></h3>
              <p class="uk-text-meta uk-margin-remove"><?= lang('active_bans') ?></p>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-grid-small" uk-grid>
            <div class="uk-width-auto">
              <span class="fa-stack bc-stack-medium">
                <span class="bc-color-violet bc-icon-drop-shadow">
                  <i class="fa-solid fa-circle fa-stack-2x"></i>
                </span>
                <i class="fa-solid fa-newspaper fa-stack-1x fa-inverse"></i>
              </span>
            </div>
            <div class="uk-width-expand">
              <h3 class="uk-h3 uk-text-bold uk-margin-remove"><span class="purecounter" data-purecounter-start="0" data-purecounter-end="<?= $total_articles ?>" data-purecounter-separator="true">0</span></h3>
              <p class="uk-text-meta uk-margin-remove"><?= lang('articles_added') ?></p>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-grid-small" uk-grid>
            <div class="uk-width-auto">
              <span class="fa-stack bc-stack-medium">
                <span class="bc-color-lime bc-icon-drop-shadow">
                  <i class="fa-solid fa-circle fa-stack-2x"></i>
                </span>
                <i class="fa-solid fa-file-lines fa-stack-1x fa-inverse"></i>
              </span>
            </div>
            <div class="uk-width-expand">
              <h3 class="uk-h3 uk-text-bold uk-margin-remove"><span class="purecounter" data-purecounter-start="0" data-purecounter-end="<?= $total_pages ?>" data-purecounter-separator="true">0</span></h3>
              <p class="uk-text-meta uk-margin-remove"><?= lang('pages_added') ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="uk-margin" uk-grid>
      <div class="uk-width-3-5@s uk-width-2-3@m">
        <div class="uk-card uk-card-default uk-margin">
          <div class="uk-card-header">
            <h3 class="uk-card-title"><i class="fa-solid fa-ellipsis-vertical"></i> <?= lang('news') ?></h3>
          </div>
          <ul class="uk-list uk-list-striped uk-margin-remove">
            <?php if (isset($articles) && ! empty($articles)): ?>
            <?php foreach ($articles as $item): ?>
            <li>
              <a target="_blank" href="<?= $item->link ?>" class="uk-button uk-button-text"><?= html_escape($item->title) ?></a>
              <p class="uk-text-meta uk-margin-remove"><i class="fa-regular fa-clock"></i> <time datetime="<?= format_date($item->date, 'c') ?>"><?= format_date($item->date, 'y-m-d, h:i A') ?></time></p>
            </li>
            <?php endforeach ?>
            <?php else: ?>
            <li><span class="uk-text-emphasis"><i class="fa-solid fa-crow"></i></span> <?= lang('wowcms_articles_empty') ?></li>
            <?php endif ?>
          </ul>
          <div class="uk-card-footer uk-padding-remove">
            <ul class="uk-subnav uk-subnav-divider">
              <li><a target="_blank" href="https://wow-cms.com/news"><i class="fa-solid fa-newspaper"></i> <?= lang('news') ?></a></li>
              <li><a target="_blank" href="https://discord.wow-cms.com"><i class="fa-solid fa-life-ring"></i> <?= lang('support') ?></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="uk-width-2-5@s uk-width-1-3@m">
        <div class="uk-card uk-card-default uk-margin bc-card-content">
          <div class="uk-card-body">
            <div class="uk-grid-small uk-margin-small-bottom" uk-grid>
              <div class="uk-width-1-2">
                <h3 class="uk-card-title uk-margin-small"><i class="fa-solid fa-ellipsis-vertical"></i> <?= lang('cms') ?></h3>
                <p class="uk-h4 uk-margin-remove"><?= config_item('cms_version') ?></p>
                <p class="uk-text-small uk-margin-remove"><i class="fa-solid fa-code-commit"></i> <?= lang('version') ?></p>
                <a href="<?= site_url('admin/update') ?>" class="uk-button uk-button-small uk-button-primary uk-margin-small-top"><?= lang('check') ?></a>
              </div>
              <div class="uk-width-1-2"></div>
            </div>
          </div>
        </div>
        <?php if (has_permission('run.tools', 'admin')): ?>
        <div class="uk-card uk-card-default uk-margin">
          <div class="uk-card-header">
            <h3 class="uk-card-title"><i class="fa-solid fa-ellipsis-vertical"></i> <?= lang('tools') ?></h3>
          </div>
          <div class="uk-card-body">
            <div class="uk-grid-small" uk-grid>
              <div class="uk-width-expand">
                <h5 class="uk-h5 uk-text-bold uk-margin-remove"><?= lang('clear_cache') ?></h5>
                <p class="uk-text-small uk-margin-remove"><span class="uk-text-danger"><i class="fa-solid fa-note-sticky"></i></span> <?= lang('clear_cache_note') ?></p>
              </div>
              <div class="uk-width-auto">
                <a href="<?= site_url('admin/tools/cache') ?>" class="uk-button uk-button-small uk-button-primary"><?= lang('clear') ?></a>
              </div>
            </div>
            <hr class="uk-hr">
            <div class="uk-grid-small" uk-grid>
              <div class="uk-width-expand">
                <h5 class="uk-h5 uk-text-bold uk-margin-remove"><?= lang('clear_sessions') ?></h5>
                <p class="uk-text-small uk-margin-remove"><span class="uk-text-danger"><i class="fa-solid fa-note-sticky"></i></span> <?= lang('clear_sessions_note') ?></p>
              </div>
              <div class="uk-width-auto">
                <a href="<?= site_url('admin/tools/sessions') ?>" class="uk-button uk-button-small uk-button-primary"><?= lang('clear') ?></a>
              </div>
            </div>
          </div>
        </div>
        <?php endif ?>
      </div>
    </div>
  </div>
</section>
