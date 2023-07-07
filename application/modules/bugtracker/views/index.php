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
				<li><a href="<?= site_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?= lang('navbar_vote_panel'); ?></a></li>
				<?php endif; ?>
				<?php if($this->wowmodule->getStatusModule('Store') == '1'): ?>
				<li><a href="<?= site_url('store'); ?>"><i class="fas fa-store"></i> <?= lang('tab_store'); ?></a></li>
				<?php endif; ?>
				<li class="uk-nav-divider"></li>
				<?php if($this->wowmodule->getStatusModule('Bugtracker') == '1'): ?>
				<li class="uk-active"><a href="<?= site_url('bugtracker'); ?>"><i class="fas fa-bug"></i> <?= lang('tab_bugtracker'); ?></a></li>
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
            <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
              <div class="uk-width-expand">
                  <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('tab_bugtracker'); ?></h4>
              </div>
              <div class="uk-width-auto">
                <?php if ($this->wowauth->isLogged()): ?>
                <div class="uk-text-center uk-text-right@s">
                  <a href="<?= site_url('bugtracker/new'); ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-pencil-alt"></i> <?= lang('button_create_report'); ?></a>
                </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="uk-overflow-auto uk-width-1-1 uk-margin">
              <table class="uk-table uk-table-hover uk-table-small uk-table-divider">
                <thead>
                  <tr>
                    <th><i class="fas fa-hashtag"></i> <?= lang('table_header_id'); ?></th>
                    <th class="uk-table-expand"><i class="fas fa-bookmark"></i> <?= lang('placeholder_title'); ?></th>
                    <th class="uk-width-small"><i class="fas fa-list"></i> <?= lang('placeholder_type'); ?></th>
                    <th class="uk-width-small uk-text-center"><i class="fas fa-exclamation-circle"></i> <?= lang('table_header_priority'); ?></th>
                    <th class="uk-width-small uk-text-center"><i class="fas fa-info-circle"></i> <?= lang('table_header_status'); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(isset($bugtrackerList) && !empty($bugtrackerList)): ?>
                  <?php foreach($bugtrackerList as $tracker): ?>
                    <tr>
                      <td class="uk-table-link">
                        <a href="<?= site_url('bugtracker/report/'.$tracker->id); ?>" class="uk-link-reset">
                          <?= $tracker->id ?>
                        </a>
                      </td>
                      <td class="uk-table-link">
                        <a href="<?= site_url('bugtracker/report/'.$tracker->id); ?>" class="uk-link-reset">
                          <?= $tracker->title ?>
                        </a>
                      </td>
                      <td><?= $this->bugtracker_model->getType($tracker->type); ?></td>
                      <td class="uk-text-center">
                        <?php if ($tracker->priority == 1): ?>
                        <span class="uk-label uk-label-danger"><?= $this->bugtracker_model->getPriority($tracker->priority); ?></span>
                        <?php elseif($tracker->priority == 2): ?>
                        <span class="uk-label uk-label-warning"><?= $this->bugtracker_model->getPriority($tracker->priority); ?></span>
                        <?php else: ?>
                        <span class="uk-label uk-label-success"><?= $this->bugtracker_model->getPriority($tracker->priority); ?></span>
                        <?php endif; ?>
                      </td>
                      <td class="uk-text-center">
                        <?php if ($tracker->status == 1 || $tracker->status == 8 || $tracker->status == 3): ?>
                        <span class="uk-label uk-label-success"><?= $this->bugtracker_model->getStatus($tracker->status); ?></span>
                        <?php elseif($tracker->status == 2 || $tracker->status == 5 || $tracker->status == 6): ?>
                        <span class="uk-label uk-label-warning"><?= $this->bugtracker_model->getStatus($tracker->status); ?></span>
                        <?php else: ?>
                        <span class="uk-label uk-label-danger"><?= $this->bugtracker_model->getStatus($tracker->status); ?></span>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td class="uk-text-warning uk-text-bold"><i class="fas fa-exclamation-circle"></i> <?= lang('bugtracker_report_notfound'); ?></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div> 
            <div class="uk-text-right">
              <?php if (isset($bugtrackerList) && is_array($bugtrackerList)) echo $pagination_links; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
