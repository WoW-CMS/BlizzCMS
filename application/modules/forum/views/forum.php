    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= html_escape($forum->name) ?></h4>
          </div>
          <div class="uk-width-auto">
            <?php if ($this->cms->isLogged()): ?>
            <a href="<?= site_url('forum/view/'.$forum->id.'/create') ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-pencil-alt"></i> <?= lang('new_topic') ?></a>
            <?php endif ?>
          </div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-3-4@m">
            <?= $template['partials']['alerts'] ?>
            <?php if (isset($subforums) && ! empty($subforums)): ?>
            <div class="uk-overflow-auto uk-margin-medium forum-table">
              <table class="uk-table uk-table-hover uk-table-middle">
                <caption><i class="fas fa-th-list"></i> <?= lang('subforums') ?></caption>
                <tbody>
                  <?php foreach ($subforums as $subforum): ?>
                  <tr>
                    <td class="uk-table-shrink">
                      <i class="forum-icon" style="background-image: url('<?= $template['uploads'].'icons/forum/'.$subforum->icon ?>')"></i>
                    </td>
                    <td class="uk-table-expand uk-text-break">
                      <a href="<?= site_url('forum/view/'.$subforum->id) ?>" class="uk-link-reset">
                        <h4 class="uk-h4 uk-margin-remove"><?= html_escape($subforum->name) ?></h4>
                      </a>
                      <p class="uk-text-meta uk-margin-remove"><?= html_escape($subforum->description) ?></p>
                    </td>
                    <td class="uk-width-small uk-text-center">
                      <span class="uk-display-block uk-text-bold"><i class="far fa-file-alt"></i> <?= $this->forum_topics->count_all($subforum->id) ?></span>
                      <span class="uk-text-small"><?= lang('topics') ?></span>
                    </td>
                    <td class="uk-width-medium">
                      <?php foreach ($this->forum_topics->last($subforum->id) as $last): ?>
                      <a href="<?= site_url('forum/topic/'.$last->id) ?>" class="uk-display-block"><?= character_limiter(html_escape($last->title), 30) ?></a>
                      <span class="uk-text-meta uk-display-block"><?= lang('created_by') ?> <span class="uk-text-primary"><?= $this->cms->user($last->user_id, 'nickname') ?></span>
                      <?php endforeach ?>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <?php endif ?>
            <h5 class="uk-h5 uk-text-uppercase uk-text-bold uk-margin-small"><?= lang('topic_list') ?></h6>
            <div class="uk-overflow-auto uk-margin-small forum-table">
              <table class="uk-table uk-table-hover uk-table-middle">
                <thead>
                  <tr>
                    <th class="uk-table-shrink"></th>
                    <th class="uk-table-expand"><?= lang('title') ?></th>
                    <th class="uk-width-small uk-text-center"><?= lang('posts') ?></th>
                    <th class="uk-width-medium"><?= lang('last_post_by') ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($topics as $topic): ?>
                  <tr>
                    <td>
                      <?php if ($topic->stick): ?>
                      <i class="fas fa-thumbtack fa-lg"></i>
                      <?php elseif ($topic->lock): ?>
                      <i class="fas fa-lock fa-lg"></i>
                      <?php else: ?>
                      <i class="fas fa-comment fa-lg"></i>
                      <?php endif ?>
                    </td>
                    <td class="uk-text-break">
                      <a href="<?= site_url('forum/topic/'.$topic->id) ?>" class="uk-link-reset">
                        <h5 class="uk-h5 uk-margin-remove"><?= html_escape($topic->title) ?></h5>
                      </a>
                      <p class="uk-text-meta uk-margin-remove"><?= lang('created_by') ?> <span class="uk-text-primary"><?= $this->cms->user($topic->user_id, 'nickname') ?></span> on <?= date('d-m-y h:i', strtotime($topic->created_at)) ?></p>
                    </td>
                    <td class="uk-text-center">
                      <i class="far fa-comment"></i> <?= $this->forum_posts->count_all($topic->id) ?>
                    </td>
                    <td class="uk-text-meta">
                      <?php foreach ($this->forum_posts->last($topic->id) as $post): ?>
                      <span class="uk-text-primary"><?= $this->cms->user($post->user_id, 'nickname') ?></span> <?= date('d-m-y h:i', strtotime($post->created_at)) ?>
                      <?php endforeach ?>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="uk-width-1-4@m uk-visible@m">
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="fas fa-book-open"></i> <?= lang('latest_activity') ?></h5>
              </div>
              <div class="uk-card-body">

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
