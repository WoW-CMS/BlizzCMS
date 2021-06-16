    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('bugtracker') ?></h4>
          </div>
          <div class="uk-width-auto">
            <?php if ($this->auth->is_moderator() || $this->session->userdata('id') == $report->user_id): ?>
            <div class="uk-inline">
              <button class="uk-icon-button" type="button"><i class="fas fa-ellipsis-v"></i></button>
              <div uk-dropdown="mode: click">
                <ul class="uk-nav uk-dropdown-nav">
                  <li><a href="<?= site_url('bugtracker/edit/'.$report->id) ?>"><i class="fas fa-edit"></i> <?= lang('edit') ?></a></li>
                </ul>
              </div>
            </div>
            <?php endif ?>
          </div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium uk-flex" data-uk-grid>
          <div class="uk-width-3-4@m">
            <div class="uk-card uk-card-default uk-margin">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold uk-margin-remove"><i class="fas fa-user-edit"></i> <?= html_escape($report->title) ?></h5>
              </div>
              <div class="uk-card-body">
                <?= $report->description ?>
              </div>
            </div>
            <?php if (isset($comments) && ! empty($comments)): ?>
            <h4 class="uk-h4 uk-margin-remove"><?= lang('comments') ?></h4>
            <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-margin-small" data-uk-grid>
              <?php foreach ($comments as $comment): ?>
              <div>
                <div class="uk-card uk-card-default">
                  <div class="uk-card-header">
                    <div class="uk-grid uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                      <div class="uk-width-auto">
                        <img class="uk-border-circle" src="<?= $template['uploads'].'avatars/'.$this->cms->user_avatar($comment->user_id) ?>" width="40" height="40" alt="Avatar">
                      </div>
                      <div class="uk-width-expand">
                        <h6 class="uk-h6 uk-margin-remove"><?= $this->cms->user($comment->user_id, 'nickname') ?></h6>
                        <p class="uk-text-meta uk-margin-remove-top"><?= date('F j, Y, H:i', strtotime($comment->created_at)) ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="uk-card-body">
                    <?= $comment->commentary ?>
                  </div>
                </div>
              </div>
              <?php endforeach ?>
            </div>
            <?= $links ?>
            <?php endif ?>
            <?php if ($this->cms->isLogged()): ?>
            <h4 class="uk-h4 uk-margin-top uk-margin-remove-bottom"><i class="fas fa-comment-dots"></i> <?= lang('your_comment') ?></h4>
            <?= form_open(site_url('bugtracker/comment')) ?>
            <?= form_hidden('id', $report->id) ?>
            <div class="uk-margin-small uk-light">
              <div class="uk-form-controls">
                <textarea class="uk-textarea textarea-comment" name="comment" rows="7"></textarea>
              </div>
              <span class="uk-text-small uk-text-danger"><?= $this->session->flashdata('form_error') ?></span>
            </div>
            <button class="uk-button uk-button-default uk-margin-small-top" type="submit"><i class="fas fa-reply"></i> <?= lang('send') ?></button>
            <?= form_close() ?>
            <?php endif ?>
          </div>
          <div class="uk-width-1-4@m uk-flex-first uk-flex-last@m">
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="fas fa-list-alt"></i> <?= lang('information') ?></h5>
              </div>
              <div class="uk-card-body">
                <ul class="uk-list uk-list-divider uk-text-small">
                  <li><span class="uk-h6 uk-text-bold uk-margin-small-right"><?= lang('author') ?>:</span> <?= $this->cms->user($report->user_id, 'nickname') ?></li>
                  <li><span class="uk-h6 uk-text-bold uk-margin-small-right"><?= lang('date') ?>:</span> <?= date('F j, Y, H:i', strtotime($report->created_at)) ?></li>
                  <li><span class="uk-h6 uk-text-bold uk-margin-small-right"><?= lang('realm') ?>:</span> <?= $this->realms->name($report->realm_id) ?></li>
                  <li><span class="uk-h6 uk-text-bold uk-margin-small-right"><?= lang('category') ?>:</span> <?= $this->bugtracker_categories->name($report->category_id) ?></li>
                  <li><span class="uk-h6 uk-text-bold uk-margin-small-right"><?= lang('priority') ?>:</span> <?= $report->priority ?></li>
                  <li><span class="uk-h6 uk-text-bold uk-margin-small-right"><?= lang('status') ?>:</span> <?= $report->status ?></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
