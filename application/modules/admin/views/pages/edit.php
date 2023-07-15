<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/pages') ?>"><?= lang('pages') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('edit_page') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <?= form_open(current_url()) ?>
      <div class="uk-margin" uk-grid>
        <div class="uk-width-3-5@s uk-width-2-3@m">
          <div class="uk-card uk-card-default uk-margin">
            <div class="uk-card-body">
              <div class="uk-grid-small uk-margin-small" uk-grid>
                <div class="uk-width-1-1">
                  <label class="uk-form-label"><?= lang('title') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="title" value="<?= $page->title ?>" placeholder="<?= lang('title') ?>" autocomplete="off">
                  </div>
                  <?= form_error('title', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-1">
                  <label class="uk-form-label"><?= lang('slug') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="slug" value="<?= $page->slug ?>" placeholder="<?= lang('slug') ?>" autocomplete="off">
                  </div>
                  <?= form_error('slug', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-1">
                  <label class="uk-form-label"><?= lang('content') ?></label>
                  <div class="uk-form-controls">
                    <textarea class="uk-textarea tmce-content" name="content" rows="12" autocomplete="off"><?= $page->content ?></textarea>
                  </div>
                  <?= form_error('content', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
          </div>
          <button class="uk-button uk-button-primary uk-visible@s" type="submit"><?= lang('save') ?></button>
        </div>
        <div class="uk-width-2-5@s uk-width-1-3@m">
          <div class="uk-card uk-card-default uk-margin">
            <div class="uk-card-header">
              <h3 class="uk-card-title"><i class="fa-solid fa-magnifying-glass"></i> <?= lang('seo') ?></h3>
            </div>
            <div class="uk-card-body">
              <div class="uk-grid-small uk-margin-small" uk-grid>
                <div class="uk-width-1-1">
                  <label class="uk-form-label"><?= lang('meta_description') ?></label>
                  <div class="uk-form-controls">
                    <textarea class="uk-textarea" name="meta_description" rows="4" autocomplete="off"><?= $page->meta_description ?></textarea>
                  </div>
                  <?= form_error('meta_description', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-1">
                  <label class="uk-form-label"><?= lang('meta_robots') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="meta_robots" value="<?= $page->meta_robots ?>" autocomplete="off">
                  </div>
                  <?= form_error('meta_robots', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
          </div>
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <h3 class="uk-card-title"><i class="fa-solid fa-eye"></i> <?= lang('permissions') ?></h3>
            </div>
            <div class="uk-card-body">
              <div class="uk-grid-small uk-child-width-1-1" uk-grid>
                <?php foreach ($roles as $role): ?>
                <div>
                  <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                      <label class="uk-switch uk-display-block">
                        <input type="checkbox" name="roles[]" value="<?= $role['id'] ?>" <?= set_checkbox('roles[]', $role['id'], $role['checked']) ?>>
                        <div class="uk-switch-slider"></div>
                      </label>
                    </div>
                    <div class="uk-width-expand">
                      <p class="uk-text-small uk-text-secondary uk-margin-remove"><?= lang_vars('role_can_view_page', [$role['name']]) ?></p>
                    </div>
                  </div>
                </div>
                <?php endforeach ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="uk-button uk-button-primary uk-hidden@s" type="submit"><?= lang('save') ?></button>
    <?= form_close() ?>
  </div>
</section>
