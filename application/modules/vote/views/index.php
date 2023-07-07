    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
				<?php if($this->wowmodule->getStatusModule('User Panel')): ?>
				<li><a href="<?= site_url('panel'); ?>"><i class="fas fa-user-circle"></i> <?= lang('tab_account'); ?></a></li>
				<?php endif; ?>
				<li class="uk-nav-divider"></li>
				<?php if($this->wowmodule->getStatusModule('Donation') == '1'): ?>
				<li><a href="<?= site_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?= lang('navbar_donate_panel'); ?></a></li>
				<?php endif; ?>
				<?php if($this->wowmodule->getStatusModule('Vote') == '1'): ?>
				<li class="uk-active"><a href="<?= site_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?= lang('navbar_vote_panel'); ?></a></li>
				<?php endif; ?>
				<?php if($this->wowmodule->getStatusModule('Store') == '1'): ?>
				<li><a href="<?= site_url('store'); ?>"><i class="fas fa-store"></i> <?= lang('tab_store'); ?></a></li>
				<?php endif; ?>
				<li class="uk-nav-divider"></li>
				<?php if($this->wowmodule->getStatusModule('Bugtracker') == '1'): ?>
				<li><a href="<?= site_url('bugtracker'); ?>"><i class="fas fa-bug"></i> <?= lang('tab_bugtracker'); ?></a></li>
				<?php endif; ?>
				<?php if($this->wowmodule->getStatusModule('Changelogs') == '1'): ?>
				<li><a href="<?= site_url('changelogs'); ?>"><i class="fas fa-scroll"></i> <?= lang('tab_changelogs'); ?></a></li>
				<?php endif; ?>
				<?php if($this->wowmodule->getStatusModule('Download') == '1'): ?>
				<li><a href="<?= site_url('download'); ?>"><i class="fas fa-download"></i> <?= lang('tab_download'); ?></a></li>
				<?php endif; ?>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('tab_vote');?></h4>
            <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-child-width-1-4@s uk-child-width-1-4@m" data-uk-grid>
              <?php foreach ($voteList as $key => $voteList): ?>
              <div>
                <div class="uk-card uk-card-vote">
                  <div class="uk-card-header">
                    <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><?=$voteList->name?></h5>
                  </div>
                  <div class="uk-card-body">
                    <div class="uk-flex uk-flex-center">
                      <img src="<?=$voteList->image?>" alt="<?=$voteList->name?>">
                    </div>
                    <p class="uk-text-small uk-text-center uk-margin-small"><?=$voteList->points?> <?= lang('panel_vp');?></p>
                    <h5 class="uk-h5 uk-text-uppercase uk-text-bold uk-text-center uk-margin-remove-bottom uk-margin-small-top"><?= lang('vote_next_time');?></h5>
                    <div class="uk-grid-collapse uk-child-width-auto uk-flex-center uk-margin-small-bottom" uk-grid uk-countdown="date: <?=date('c', $this->vote_model->getTimeLogExpired($voteList->id, $this->session->userdata('wow_sess_id')));?>">
                      <div>
                        <div class="uk-countdown-number uk-countdown-days"></div>
                      </div>
                      <div class="uk-countdown-separator">:</div>
                      <div>
                        <div class="uk-countdown-number uk-countdown-hours"></div>
                      </div>
                      <div class="uk-countdown-separator">:</div>
                      <div>
                        <div class="uk-countdown-number uk-countdown-minutes"></div>
                      </div>
                      <div class="uk-countdown-separator">:</div>
                      <div>
                        <div class="uk-countdown-number uk-countdown-seconds"></div>
                      </div>
                    </div>
                    <?php if ($this->wowgeneral->getTimestamp() >= $this->vote_model->getTimeLogExpired($voteList->id, $this->session->userdata('wow_sess_id'))): ?>
                      <?=form_open(site_url('vote/votenow/' . $voteList->id));?>
                        <button class="uk-button uk-button-default uk-width-1-1"><i class="fas fa-vote-yea"></i> <?= lang('tab_vote');?></button>
                      <?=form_close();?>
                    <?php else: ?>
                      <?=form_open();?>
                        <button class="uk-button uk-button-default uk-width-1-1" disabled><i class="fas fa-vote-yea"></i> <?= lang('tab_vote');?></button>
                      <?=form_close();?>
                    <?php endif;?>
                  </div>
                </div>
              </div>
              <?php endforeach;?>
            </div>
          </div>
        </div>
      </div>
    </section>
