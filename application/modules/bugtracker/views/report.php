    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <li><a href="<?= base_url('user'); ?>"><i class="fas fa-user-circle"></i> <?= lang('tab_account'); ?></a></li>
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
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-header">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-width-expand@s">
                    <h5 class="uk-h5 uk-text-bold"><i class="fas fa-bug"></i> <?= $report->title; ?></h5>
                  </div>
                  <div class="uk-width-auto@s">
                    <p class="uk-text-small"><i class="far fa-clock"></i> <?= date('F j, Y, h:i a', $report->date); ?></p>
                  </div>
                </div>
              </div>
              <div class="uk-card-body">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-width-3-4@s">
                    <?= $report->description; ?>
                  </div>
                  <div class="uk-width-1-4@s">
                    <ul class="uk-list uk-text-small">
                      <li><i class="far fa-user-circle"></i> <?= lang('author'); ?>: <?= $this->auth->get_user($report->author, 'nickname'); ?></li>
                      <li><i class="fas fa-list"></i> <?= lang('type'); ?>: <span class="uk-label"><?= $this->bugtracker_model->getType($report->type); ?></span></li>
                      <li><i class="fas fa-exclamation-circle"></i> <?= lang('priority'); ?>: <span class="uk-label uk-label-danger"><?= $this->bugtracker_model->getPriority($report->priority); ?></span></li>
                      <li><i class="fas fa-tags"></i> <?= lang('status'); ?>: <span class="uk-label uk-label-success"><?= $this->bugtracker_model->getStatus($report->status); ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <?php if ($this->auth->is_moderator()): ?>
            <div class="uk-grid uk-grid-small uk-grid-divider uk-child-width-1-1 uk-child-width-1-3@m uk-margin-small" data-uk-grid>
              <div>
                <?= form_open(site_url('bugtracker/priority')); ?>
                  <?= form_hidden('id', $report->id); ?>
                  <div class="uk-margin uk-light">
                    <div class="uk-form-controls">
                      <select class="uk-select uk-width-1-1" id="form-stacked-select" name="priority">
                        <?php foreach($this->bugtracker_model->all_priorities() as $priory): ?>
                        <option value="<?= $priory->id ?>"><?= $priory->title ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="uk-margin-small">
                    <button class="uk-button uk-button-default uk-width-1-1" type="submit"><i class="fas fa-sync-alt"></i> <?= lang('save_changes'); ?></button>
                  </div>
                <?= form_close(); ?>
              </div>
              <div>
                <?= form_open(site_url('bugtracker/status')); ?>
                  <?= form_hidden('id', $report->id); ?>
                  <div class="uk-margin uk-light">
                    <div class="uk-form-controls">
                      <select class="uk-select uk-width-1-1" id="form-stacked-select" name="status">
                        <?php foreach($this->bugtracker_model->all_status() as $priory): ?>
                        <option value="<?= $priory->id ?>"><?= $priory->title ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="uk-margin-small">
                    <button class="uk-button uk-button-default uk-width-1-1" type="submit"><i class="fas fa-sync-alt"></i> <?= lang('save_changes'); ?></button>
                  </div>
                <?= form_close(); ?>
              </div>
              <div>
                <?= form_open(site_url('bugtracker/type')); ?>
                  <?= form_hidden('id', $report->id); ?>
                  <div class="uk-margin uk-light">
                    <div class="uk-form-controls">
                      <select class="uk-select uk-width-1-1" id="form-stacked-select" name="type">
                        <?php foreach($this->bugtracker_model->all_types() as $priory): ?>
                        <option value="<?= $priory->id ?>"><?= $priory->title ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="uk-margin-small">
                    <button class="uk-button uk-button-default uk-width-1-1" type="submit"><i class="fas fa-sync-alt"></i> <?= lang('save_changes'); ?></button>
                  </div>
                <?= form_close(); ?>
              </div>
            </div>
            <div>
              <?= form_open(site_url('bugtracker/close')); ?>
                <?= form_hidden('id', $report->id); ?>
                <div class="uk-margin-small">
                  <button class="uk-button uk-button-danger uk-width-1-1"><i class="fas fa-times-circle" type="submit"></i> <?= lang('close'); ?></button>
                </div>
              <?= form_close(); ?>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
