    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('forum') ?></h4>
          </div>
          <div class="uk-width-auto">
            <?php if ($this->website->isLogged() && $topic->user_id == $this->session->userdata('id')): ?>
            <a href="<?= site_url('forum/topic/'.$topic->id.'/edit') ?>" class="uk-button uk-button-default uk-button-small"><i class="far fa-edit"></i> <?= lang('edit_topic') ?></a>
            <?php endif ?>
          </div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <?= $template['partials']['alerts'] ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <div class="uk-grid uk-grid-small" data-uk-grid>
              <div class="uk-width-expand">
                <h4 class="uk-h4 uk-text-bold"><i class="fas fa-comment"></i> <?= html_escape($topic->title) ?></h4>
              </div>
              <div class="uk-width-auto"></div>
            </div>
          </div>
          <div class="uk-card-body">
            <div class="uk-grid uk-grid-small" data-uk-grid>
              <div class="uk-width-1-6@s">
                <div class="author <?php if ($this->auth->get_gmlevel($topic->user_id) > 0) echo 'topic-author-staff' ?> uk-flex uk-flex-center">
                  <div class="topic-author-avatar profile">
                    <img src="<?= $template['uploads'].'avatars/'.$this->website->user_avatar($topic->user_id) ?>" alt="Avatar">
                  </div>
                </div>
                <p class="uk-text-bold uk-text-center uk-margin-remove"><?= $this->website->get_user($topic->user_id, 'nickname') ?></p>
                <?php if ($this->auth->get_gmlevel($topic->user_id) > 0): ?>
                <div class="author-rank-staff"><i class="fas fa-fire"></i> Staff</div>
                <?php endif ?>
              </div>
              <div class="uk-width-expand@s">
                <p class="uk-text-small uk-text-meta uk-margin-remove"><?= date('F j, Y, H:i', $topic->created_at) ?></p>
                <?= $topic->description ?>
              </div>
            </div>
          </div>
        </div>
        <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-margin" data-uk-grid>
          <?php foreach ($posts as $post): ?>
          <div>
            <div class="uk-card uk-card-default">
              <div class="uk-card-body">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-width-1-6@s">
                    <div class="author <?php if ($this->auth->get_gmlevel($post->user_id) > 0) echo 'topic-author-staff' ?> uk-flex uk-flex-center">
                      <div class="topic-author-avatar profile">
                        <img src="<?= $template['uploads'].'avatars/'.$this->website->user_avatar($post->user_id) ?>" alt="Avatar">
                      </div>
                    </div>
                    <p class="uk-text-bold uk-text-center uk-margin-remove"><?= $this->website->get_user($post->user_id, 'nickname') ?></p>
                    <?php if ($this->auth->get_gmlevel($post->user_id) > 0): ?>
                    <div class="author-rank-staff"><i class="fas fa-fire"></i> Staff</div>
                    <?php endif ?>
                  </div>
                  <div class="uk-width-expand@s">
                    <p class="uk-text-meta uk-margin-remove"><?= date('F j, Y, H:i', $post->created_at) ?></p>
                    <?= $post->commentary ?>
                  </div>
                </div>
              </div>
              <div class="uk-card-footer">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-width-expand"></div>
                  <div class="uk-width-auto">
                    <?php if ($this->auth->is_moderator() || $this->session->userdata('id') == $post->user_id && now() < strtotime('+30 minutes', $post->created_at)): ?>
                    <a href="<?= site_url('forum/post/delete/'.$post->id) ?>" class="uk-button uk-button-danger uk-button-small"><i class="fas fa-trash-alt"></i> <?= lang('delete') ?></a>
                    <?php endif ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach ?>
          <?php if ($topic->lock): ?>
          <div>
            <h3 class="uk-h3 uk-text-center uk-margin-small"><span uk-icon="icon: lock; ratio: 1.5"></span> <?= lang('not_authorized') ?></h3>
            <div class="uk-card uk-card-default uk-card-body">
              <div class="glass-box-container">
                <p class="uk-margin-small"><?= lang('topic_locked') ?></p>
              </div>
            </div>
          </div>
          <?php elseif ($this->website->isLogged() && ! $topic->lock): ?>
          <div>
            <h3 class="uk-h3 uk-text-center uk-margin-small"><span uk-icon="icon: comment; ratio: 1.5"></span> <?= lang('join_conversation') ?></h3>
            <div class="uk-card uk-card-default uk-card-body">
              <?= form_open(site_url('forum/post')) ?>
              <?= form_hidden('id', $topic->id) ?>
              <div class="uk-margin-small uk-light">
                <div class="uk-form-controls">
                  <textarea class="uk-textarea tinyeditor" name="comment" rows="10"></textarea>
                </div>
                <span class="uk-text-small uk-text-danger"><?= $this->session->flashdata('form_error') ?></span>
              </div>
              <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-top" type="submit"><i class="fas fa-reply"></i> <?= lang('send') ?></button>
              <?= form_close() ?>
            </div>
          </div>
          <?php endif ?>
        </div>
      </div>
    </section>