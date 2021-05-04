    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-3-4@m">
            <?= $template['partials']['alerts']; ?>
            <div class="uk-card uk-card-default uk-margin">
              <div class="uk-card-header">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-width-expand@s">
                    <h5 class="uk-h5 uk-text-bold"><i class="fas fa-newspaper"></i> <?= html_escape($news->title); ?></h5>
                  </div>
                  <div class="uk-width-auto@s">
                    <p class="uk-text-small"><i class="far fa-clock"></i> <?= date('F j, Y, H:i', $news->created_at); ?></p>
                  </div>
                </div>
              </div>
              <div class="uk-card-body">
                <?= $news->description; ?>
              </div>
            </div>
            <?php if (isset($comments) && ! empty($comments)): ?>
            <h4 class="uk-h4 uk-margin-remove"><?= lang('comments'); ?></h4>
            <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-margin-small" data-uk-grid>
              <?php foreach ($comments as $comment): ?>
              <div>
                <div class="uk-card uk-card-default">
                  <div class="uk-card-header">
                    <div class="uk-grid uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                      <div class="uk-width-auto">
                        <img class="uk-border-circle" src="<?= $template['uploads'].'avatars/'.$this->website->user_avatar($comment->user_id); ?>" width="40" height="40" alt="Avatar">
                      </div>
                      <div class="uk-width-expand">
                        <h6 class="uk-h6 uk-margin-remove"><?= $this->website->get_user($comment->user_id, 'nickname'); ?></h6>
                        <p class="uk-text-meta uk-margin-remove-top"><?= date('F j, Y, H:i', $comment->created_at); ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="uk-card-body">
                    <?= $comment->commentary; ?>
                  </div>
                  <div class="uk-card-footer">
                    <div class="uk-grid uk-grid-small" data-uk-grid>
                      <div class="uk-width-expand"></div>
                      <div class="uk-width-auto">
                        <?php if ($this->auth->is_moderator() || $this->session->userdata('id') == $comment->user_id && now() < strtotime('+30 minutes', $comment->created_at)): ?>
                        <a href="<?= site_url('news/comment/delete/'.$comment->id); ?>" class="uk-button uk-button-danger uk-button-small"><i class="fas fa-trash-alt"></i> <?= lang('delete'); ?></a>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
            <?= $links; ?>
            <?php endif; ?>
            <?php if ($this->website->isLogged()): ?>
            <h4 class="uk-h4 uk-margin-top uk-margin-remove-bottom"><i class="fas fa-comment-dots"></i> <?= lang('your_comment'); ?></h4>
            <div class="uk-card uk-card-default uk-card-body uk-margin-small">
              <?= form_open(site_url('news/comment')); ?>
              <?= form_hidden('id', $news->id); ?>
              <div class="uk-margin-small uk-light">
                <div class="uk-form-controls">
                  <textarea class="uk-textarea tinyeditor" name="comment" rows="10"></textarea>
                </div>
                <span class="uk-text-small uk-text-danger"><?= $this->session->flashdata('form_error'); ?></span>
              </div>
              <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-top" type="submit"><i class="fas fa-reply"></i> <?= lang('send'); ?></button>
              <?= form_close(); ?>
            </div>
            <?php endif; ?>
          </div>
          <div class="uk-width-1-4@m">
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="fas fa-list-alt"></i> <?= lang('latest_news'); ?></h5>
              </div>
              <div class="uk-card-body">
                <ul class="uk-list uk-list-divider uk-text-small">
                  <?php foreach ($aside as $item): ?>
                  <li>
                    <a href="<?= site_url('news/'.$item->id); ?>"><i class="far fa-newspaper"></i> <?= html_escape($item->title); ?></a>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>