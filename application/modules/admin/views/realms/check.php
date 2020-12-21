    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('check'); ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin'); ?>"><?= lang('dashboard'); ?></a></li>
              <li><a href="<?= site_url('admin/realms'); ?>"><?= lang('realms'); ?></a></li>
              <li><span><?= lang('check'); ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto"></div>
        </div>
        <?= $template['partials']['alerts']; ?>
        <pre><code><?= $check; ?></code></pre>
        <a href="<?= current_url(); ?>" class="uk-button uk-button-primary"><i class="fas fa-sync"></i> <?= lang('reload'); ?></a>
      </div>
    </section>