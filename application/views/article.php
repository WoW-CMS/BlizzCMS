<section class="uk-section uk-section-small bc-primary-section" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
          <li><a href="<?= site_url('news') ?>"><?= lang('news') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= html_escape($article->title) ?></h1>
        <p class="uk-text-meta uk-margin-remove"><i class="fa-solid fa-calendar-day"></i> <time datetime="<?= $article->created_at ?>"><?= locate_date($article->created_at) ?></time></p>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <div class="uk-margin" uk-grid>
      <div class="uk-width-2-3@s uk-width-3-4@m">
        <?= $template['partials']['alerts'] ?>
        <div class="uk-card uk-card-default uk-margin">
          <div class="uk-card-media-top uk-cover-container">
            <img src="<?= $template['uploads'].$article->image ?>" alt="<?= $article->title ?>" uk-cover>
            <canvas width="890" height="250"></canvas>
          </div>
          <div class="uk-card-body uk-text-break">
            <?= $article->content ?>
          </div>
        </div>
        <?php if ($article->discuss): ?>
        <?php if (isset($comments) && ! empty($comments)): ?>
        <div class="uk-grid-small uk-margin-small uk-flex uk-flex-middle" uk-grid>
          <div class="uk-width-expand">
            <h3 class="uk-h4 uk-margin-remove"><?= lang('comments') ?></h3>
          </div>
          <div class="uk-width-auto">
            <?= $pagination ?>
          </div>
        </div>
        <div class="uk-grid-small uk-child-width-1-1 uk-margin-small-top uk-margin-bottom" uk-grid>
          <?php foreach ($comments as $comment): ?>
          <div>
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                  <div class="uk-width-expand">
                    <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                      <div class="uk-width-auto">
                        <img class="uk-border-circle" src="<?= user_avatar($comment->user_id) ?>" width="32" height="32" alt="<?= lang('avatar') ?>">
                      </div>
                      <div class="uk-width-expand">
                        <h6 class="uk-h6 uk-margin-remove"><?= $comment->nickname ?></h6>
                        <p class="uk-text-meta uk-margin-remove"><?= lang('written_on') ?> <time datetime="<?= $comment->created_at ?>"><?= locate_date($comment->created_at) ?></time></p>
                      </div>
                    </div>
                  </div>
                  <div class="uk-width-auto">
                    <?php if (is_logged_in()): ?>
                    <div class="uk-inline">
                      <button class="uk-icon-button" type="button"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                      <div uk-dropdown="mode: click; boundary: ! .uk-container">
                        <ul class="uk-nav uk-dropdown-nav">
                          <?php if (has_permission('edit.newscomments', ':base:') || has_permission('editown.newscomments', ':base:') && $comment->user_id === $this->session->userdata('id')): ?>
                          <li><a href="<?= site_url('news/comment/edit/'.$comment->id) ?>"><span class="bc-li-icon"><i class="fa-solid fa-pen-to-square"></i></span><?= lang('edit') ?></a></li>
                          <?php endif ?>
                          <?php if (has_permission('delete.newscomments', ':base:') || has_permission('deleteown.newscomments', ':base:') && $comment->user_id === $this->session->userdata('id')): ?>
                          <li><a href="<?= site_url('news/comment/delete/'.$comment->id) ?>"><span class="bc-li-icon"><i class="fa-solid fa-trash-can"></i></span><?= lang('delete') ?></a></li>
                          <?php endif ?>
                        </ul>
                      </div>
                    </div>
                    <?php endif ?>
                  </div>
                </div>
              </div>
              <div class="uk-card-body uk-text-break">
                <?= $comment->comment_content ?>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>
        <?php endif ?>
        <div class="uk-grid-small uk-margin-small uk-flex uk-flex-middle" uk-grid>
          <div class="uk-width-expand">
            <?php if (is_logged_in()): ?>
            <h3 class="uk-h4 uk-margin-remove"><i class="fa-solid fa-comment"></i> <?= lang('add_comment') ?></h3>
            <?php endif ?>
          </div>
          <div class="uk-width-auto">
            <?php if (isset($comments) && ! empty($comments)): ?>
            <?= $pagination ?>
            <?php endif ?>
          </div>
        </div>
        <?php if (is_logged_in()): ?>
        <?= form_open(site_url('news/comment/add/'.$article->id)) ?>
          <div class="uk-margin">
            <div class="uk-form-controls">
              <textarea class="uk-textarea tmce-comment" name="comment" rows="7" autocomplete="off"></textarea>
            </div>
            <span class="uk-text-small uk-text-danger"><?= $this->session->flashdata('form_error') ?></span>
          </div>
          <button class="uk-button uk-button-default" type="submit"><?= lang('send') ?></button>
        <?= form_close() ?>
        <?php endif ?>
        <?php endif ?>
      </div>
      <div class="uk-width-1-3@s uk-width-1-4@m">
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h3 class="uk-card-title"><i class="fa-solid fa-rectangle-list"></i> <?= lang('latest_news') ?></h3>
          </div>
          <div class="uk-card-body">
            <?php if (isset($aside) && ! empty($aside)): ?>
            <ul class="uk-list uk-list-divider uk-text-small">
              <?php foreach ($aside as $item): ?>
              <li>
                <a href="<?= site_url('news/'.$item->id.'/'.$item->slug) ?>"><?= word_limiter($item->title, 10) ?></a>
                <p class="uk-text-meta uk-margin-remove"><i class="fa-solid fa-calendar-day"></i> <time datetime="<?= $item->created_at ?>"><?= locate_date($item->created_at) ?></time></p>
              </li>
              <?php endforeach ?>
            </ul>
            <?php endif ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
