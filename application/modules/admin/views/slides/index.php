<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/appearance') ?>"><?= lang('appearance') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('slides') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <div class="uk-margin" uk-grid>
      <div class="uk-width-1-3@s uk-width-1-4@m">
        <div class="uk-card uk-card-default">
          <ul class="uk-nav-default" uk-nav>
            <li class="uk-nav-header"><?= lang('base') ?></li>
            <li><a href="<?= site_url('admin/appearance') ?>"><?= lang('themes') ?></a></li>
            <li><a href="<?= site_url('admin/languages') ?>"><?= lang('languages') ?></a></li>
            <li class="uk-nav-header"><?= lang('sections') ?></li>
            <li><a href="<?= site_url('admin/menus') ?>"><?= lang('menus') ?></a></li>
            <li class="uk-active"><a href="<?= site_url('admin/slides') ?>"><?= lang('slides') ?></a></li>
          </ul>
        </div>
      </div>
      <div class="uk-width-expand@s">
        <?= $template['partials']['alerts'] ?>
        <div class="uk-card uk-card-default uk-card-header uk-margin">
          <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
            <div class="uk-width-expand">
              <h3 class="uk-card-title"><?= lang('slides') ?></h3>
            </div>
            <div class="uk-width-auto">
              <a href="<?= site_url('admin/slides/add') ?>" class="uk-button uk-button-default uk-button-small"><i class="fa-solid fa-pen"></i> <?= lang('add') ?></a>
            </div>
          </div>
        </div>
        <div class="uk-grid-small uk-child-width-1-1" uk-grid>
          <?php foreach ($slides as $item): ?>
          <div>
            <div class="uk-card uk-card-default uk-card-body">
              <div class="uk-flex uk-flex-middle" uk-grid>
                <div class="uk-width-auto">
                  <div class="uk-button-vertical-group">
                    <?php if ((int) $item->sort > 1): ?>
                    <a href="<?= site_url('admin/slides/move/'.$item->id.'/up') ?>" class="uk-button uk-button-default bc-button-xsmall"><i class="fa-solid fa-caret-up"></i></a>
                    <?php else: ?>
                    <button class="uk-button uk-button-default bc-button-xsmall" type="button" disabled><i class="fa-solid fa-caret-up"></i></button>
                    <?php endif ?>
                    <?php if ((int) $item->sort < $last): ?>
                    <a href="<?= site_url('admin/slides/move/'.$item->id.'/down') ?>" class="uk-button uk-button-default bc-button-xsmall"><i class="fa-solid fa-caret-down"></i></a>
                    <?php else: ?>
                    <button class="uk-button uk-button-default bc-button-xsmall" type="button" disabled><i class="fa-solid fa-caret-down"></i></button>
                    <?php endif ?>
                  </div>
                </div>
                <div class="uk-width-expand">
                  <h5 class="uk-text-bold uk-margin-remove"><?= html_escape($item->title) ?></h5>
                  <p class="uk-text-small uk-margin-remove"><?= word_limiter($item->description, 15) ?></p>
                </div>
                <div class="uk-width-auto">
                  <div class="uk-button-group">
                    <a href="<?= site_url('admin/slides/edit/'.$item->id) ?>" class="uk-button uk-button-primary uk-button-small"><?= lang('edit') ?></a>
                    <div class="uk-inline">
                      <button class="uk-button uk-button-primary uk-button-small" type="button"><i class="fa-solid fa-caret-down"></i></button>
                      <div uk-dropdown="mode: click; boundary: ! .uk-container">
                        <ul class="uk-nav uk-dropdown-nav">
                          <li><a href="<?= site_url('admin/slides/delete/'.$item->id) ?>" class="uk-text-danger"><span class="bc-li-icon"><i class="fa-solid fa-trash-can"></i></span><?= lang('delete') ?></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
</section>
