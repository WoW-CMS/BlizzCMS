    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('changelogs'); ?></h4>
          </div>
          <div class="uk-width-auto"></div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="far fa-list-alt"></i> <?= lang('menu'); ?></h5>
              </div>
              <ul class="uk-nav-default aside-nav uk-nav-parent-icon" uk-nav>
                <li><a href="<?= site_url('user'); ?>"><i class="fas fa-user-circle"></i> <?= lang('my_account'); ?></a></li>
                <li><a href="<?= site_url('user/settings') ?>"><i class="fas fa-tools"></i> <?= lang('account_settings'); ?></a></li>
                <li><a href="<?= site_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?= lang('donate_panel'); ?></a></li>
                <li><a href="<?= site_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?= lang('vote_panel'); ?></a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@m">
            <?php if (isset($changelogs) && ! empty($changelogs)): ?>
            <div class="uk-grid uk-grid-small uk-child-width-1-1" data-uk-grid>
              <?php foreach ($changelogs as $changelog): ?>
              <div>
                <div class="uk-card uk-card-default uk-margin-small">
                  <div class="uk-card-header">
                    <div class="uk-grid uk-grid-small" data-uk-grid>
                      <div class="uk-width-expand@s">
                        <h5 class="uk-h5 uk-text-bold"><i class="fas fa-file-alt"></i> <?= html_escape($changelog->title); ?></h5>
                      </div>
                      <div class="uk-width-auto@s">
                        <p class="uk-text-small"><i class="far fa-clock"></i> <?= date('F j, Y, H:i', $changelog->created_at); ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="uk-card-body">
                    <?= $changelog->description; ?>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
            <?= $links; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
