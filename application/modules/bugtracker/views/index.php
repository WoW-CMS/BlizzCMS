    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <li><a href="<?= base_url('panel'); ?>"><i class="fas fa-user-circle"></i> <?= lang('tab_account'); ?></a></li>
              <li class="uk-nav-divider"></li>
              <li><a href="<?= base_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?=lang('navbar_donate_panel'); ?></a></li>
              <li><a href="<?= base_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?=lang('navbar_vote_panel'); ?></a></li>
              <li><a href="<?= base_url('store'); ?>"><i class="fas fa-store"></i> <?=lang('tab_store'); ?></a></li>
              <li class="uk-nav-divider"></li>
              <li class="uk-active"><a href="<?= base_url('bugtracker'); ?>"><i class="fas fa-bug"></i> <?=lang('tab_bugtracker'); ?></a></li>
              <li><a href="<?= base_url('changelogs'); ?>"><i class="fas fa-scroll"></i> <?=lang('tab_changelogs'); ?></a></li>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
              <div class="uk-width-expand">
                  <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('tab_bugtracker'); ?></h4>
              </div>
              <div class="uk-width-auto">
                <?php if ($this->website->isLogged()): ?>
                <div class="uk-text-center uk-text-right@s">
                  <a href="<?= base_url('bugtracker/new'); ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-pencil-alt"></i> <?= lang('button_create_report'); ?></a>
                </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="uk-overflow-auto uk-width-1-1 uk-margin">
              <table class="uk-table uk-table-hover uk-table-small uk-table-divider">
                <thead>
                  <tr>
                    <th><i class="fas fa-hashtag"></i> <?=lang('table_header_id'); ?></th>
                    <th class="uk-table-expand"><i class="fas fa-bookmark"></i> <?= lang('placeholder_title'); ?></th>
                    <th class="uk-width-small"><i class="fas fa-list"></i> <?= lang('placeholder_type'); ?></th>
                    <th class="uk-width-small uk-text-center"><i class="fas fa-exclamation-circle"></i> <?= lang('table_header_priority'); ?></th>
                    <th class="uk-width-small uk-text-center"><i class="fas fa-info-circle"></i> <?= lang('table_header_status'); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($reports as $report): ?>
                  <tr>
                    <td class="uk-table-link">
                      <a href="<?= base_url('bugtracker/report/'.$report->id); ?>" class="uk-link-reset">
                        <?= $report->id; ?>
                      </a>
                    </td>
                    <td class="uk-table-link">
                      <a href="<?= base_url('bugtracker/report/'.$report->id); ?>" class="uk-link-reset">
                        <?= $report->title; ?>
                      </a>
                    </td>
                    <td><?= $this->bugtracker_model->getType($report->type); ?></td>
                    <td class="uk-text-center">
                      <?php if ($report->priority == 1): ?>
                      <span class="uk-label uk-label-danger"><?= $this->bugtracker_model->getPriority($report->priority); ?></span>
                      <?php elseif($report->priority == 2): ?>
                      <span class="uk-label uk-label-warning"><?= $this->bugtracker_model->getPriority($report->priority); ?></span>
                      <?php else: ?>
                      <span class="uk-label uk-label-success"><?= $this->bugtracker_model->getPriority($report->priority); ?></span>
                      <?php endif; ?>
                    </td>
                    <td class="uk-text-center">
                      <?php if ($report->status == 1 || $report->status == 8 || $report->status == 3): ?>
                      <span class="uk-label uk-label-success"><?= $this->bugtracker_model->getStatus($report->status); ?></span>
                      <?php elseif ($report->status == 2 || $report->status == 5 || $report->status == 6): ?>
                      <span class="uk-label uk-label-warning"><?= $this->bugtracker_model->getStatus($report->status); ?></span>
                      <?php else: ?>
                      <span class="uk-label uk-label-danger"><?= $this->bugtracker_model->getStatus($report->status); ?></span>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <?php if (isset($reports) && ! empty($reports)): ?>
            <?= $links; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
