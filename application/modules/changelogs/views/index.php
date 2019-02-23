    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-small main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <?php if($this->m_modules->getUCPStatus() == '1'): ?>
              <li><a href="<?= base_url('panel') ?>"><i class="fas fa-user-circle"></i> <?= $this->lang->line('nav_account'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->m_modules->getDonationStatus() == '1'): ?>
              <li><a href="<?= base_url('donate') ?>"><i class="fas fa-hand-holding-usd"></i> <?=$this->lang->line('button_donate_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->m_modules->getVoteStatus() == '1'): ?>
              <li><a href="<?= base_url('vote') ?>"><i class="fas fa-vote-yea"></i> <?=$this->lang->line('button_vote_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->m_modules->getStoreStatus() == '1'): ?>
              <li><a href="<?= base_url('store') ?>"><i class="fas fa-store"></i> <?=$this->lang->line('nav_store'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->m_modules->getBugtrackerStatus() == '1'): ?>
              <li><a href="<?= base_url('bugtracker') ?>"><i class="fas fa-bug"></i> <?=$this->lang->line('nav_bugtracker'); ?></a></li>
              <?php endif; ?>
              <?php if($this->m_modules->getChangelogsStatus() == '1'): ?>
              <li class="uk-active"><a href="<?= base_url('changelogs') ?>"><i class="fas fa-scroll"></i> <?=$this->lang->line('nav_changelogs'); ?></a></li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-history"></i> <?= $this->lang->line('nav_changelogs'); ?></h4>
            <?php if($this->changelogs_model->getAll()->num_rows()): ?>
            <div class="uk-grid uk-grid-small uk-child-width-1-1" data-uk-grid>
              <?php foreach($this->changelogs_model->getChangelogs()->result() as $changelogsList): ?>
              <div>
                <article class="uk-article">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-expand">
                      <h4 class="uk-h5 uk-text-bold"><i class="fas fa-file-alt"></i> <?= $changelogsList->title ?></h5>
                    </div>
                    <div class="uk-width-auto">
                      <p class="uk-text-small"><i class="far fa-clock"></i> <?= date('F j, Y, h:i a', $changelogsList->date); ?></p>
                    </div>
                  </div>
                  <div class="uk-card uk-card-default uk-card-body uk-margin-small">
                    <?= $changelogsList->description ?>
                  </div>
                </article>
              </div>
              <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="uk-alert-warning" uk-alert>
              <p class="uk-text-center"><i class="fas fa-exclamation-triangle"></i> <?= $this->lang->line('changelog_not_found'); ?></p>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
