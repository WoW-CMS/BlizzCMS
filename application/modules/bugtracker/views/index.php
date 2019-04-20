    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <?php if($this->wowmodule->getUCPStatus() == '1'): ?>
              <li><a href="<?= base_url('panel'); ?>"><i class="fas fa-user-circle"></i> <?= $this->lang->line('tab_account'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->wowmodule->getDonationStatus() == '1'): ?>
              <li><a href="<?= base_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?=$this->lang->line('navbar_donate_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getVoteStatus() == '1'): ?>
              <li><a href="<?= base_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?=$this->lang->line('navbar_vote_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getStoreStatus() == '1'): ?>
              <li><a href="<?= base_url('store'); ?>"><i class="fas fa-store"></i> <?=$this->lang->line('tab_store'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->wowmodule->getBugtrackerStatus() == '1'): ?>
              <li class="uk-active"><a href="<?= base_url('bugtracker'); ?>"><i class="fas fa-bug"></i> <?=$this->lang->line('tab_bugtracker'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getChangelogsStatus() == '1'): ?>
              <li><a href="<?= base_url('changelogs'); ?>"><i class="fas fa-scroll"></i> <?=$this->lang->line('tab_changelogs'); ?></a></li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
              <div class="uk-width-expand">
                  <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= $this->lang->line('tab_bugtracker'); ?></h4>
              </div>
              <div class="uk-width-auto">
                <?php if ($this->wowauth->isLogged()): ?>
                <div class="uk-text-center uk-text-right@s">
                  <a href="<?= base_url('bugtracker/new'); ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-pencil-alt"></i> <?= $this->lang->line('button_create_report'); ?></a>
                </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="uk-overflow-auto uk-width-1-1 uk-margin">
              <table class="uk-table uk-table-hover uk-table-small uk-table-divider">
                <thead>
                  <tr>
                    <th><i class="fas fa-hashtag"></i> <?=$this->lang->line('table_header_id'); ?></th>
                    <th class="uk-table-expand"><i class="fas fa-bookmark"></i> <?= $this->lang->line('placeholder_title'); ?></th>
                    <th class="uk-width-small"><i class="fas fa-list"></i> <?= $this->lang->line('placeholder_type'); ?></th>
                    <th class="uk-width-small uk-text-center"><i class="fas fa-exclamation-circle"></i> <?= $this->lang->line('table_header_priority'); ?></th>
                    <th class="uk-width-small uk-text-center"><i class="fas fa-info-circle"></i> <?= $this->lang->line('table_header_status'); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(isset($bugtrackerList) && !empty($bugtrackerList)): ?>
                  <?php foreach($bugtrackerList as $tracker): ?>
                    <tr>
                      <td class="uk-table-link">
                        <a href="<?= base_url('bugtracker/report/'.$tracker->id); ?>" class="uk-link-reset">
                          <?= $tracker->id ?>
                        </a>
                      </td>
                      <td class="uk-table-link">
                        <a href="<?= base_url('bugtracker/report/'.$tracker->id); ?>" class="uk-link-reset">
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
                      <td class="uk-text-warning uk-text-bold"><i class="fas fa-exclamation-circle"></i> <?= $this->lang->line('bugtracker_report_notfound'); ?></td>
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
