    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('forum') ?></h4>
          </div>
          <div class="uk-width-auto"></div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium uk-margin-small" data-uk-grid>
          <div class="uk-width-3-4@m">
            <?php foreach ($categories as $category): ?>
            <div class="uk-overflow-auto uk-margin-medium forum-table">
              <table class="uk-table uk-table-hover uk-table-middle">
                <caption uk-toggle="target: #cat-<?= $category->id ?>;animation: uk-animation-fade"><i class="fas fa-bookmark"></i> <?= $category->name ?></caption>
                <tbody id="cat-<?= $category->id ?>">
                  <?php foreach ($this->forum->find_all($category->id, 'forum') as $forum): ?>
                  <tr>
                    <td class="uk-table-shrink">
                      <i class="forum-icon" style="background-image: url('<?= $template['uploads'].'icons/forum/'.$forum->icon ?>')"></i>
                    </td>
                    <td class="uk-table-expand uk-text-break">
                      <a href="<?= site_url('forum/view/'.$forum->id) ?>" class="uk-link-reset">
                        <h4 class="uk-h4 uk-margin-remove"><?= html_escape($forum->name) ?></h4>
                      </a>
                      <p class="uk-text-meta uk-margin-remove"><?= html_escape($forum->description) ?></p>
                    </td>
                    <td class="uk-width-small uk-text-center">
                      <span class="uk-display-block uk-text-bold"><i class="far fa-file-alt"></i> <?= $this->forum_topics->count_all($forum->id) ?></span>
                      <span class="uk-text-small"><?= lang('topics') ?></span>
                    </td>
                    <td class="uk-width-medium">
                      <?php foreach ($this->forum_topics->last($forum->id) as $last): ?>
                      <a href="<?= site_url('forum/topic/'.$last->id) ?>" class="uk-display-block"><?= character_limiter(html_escape($last->title), 30) ?></a>
                      <span class="uk-text-meta uk-display-block"><?= lang('created_by') ?> <span class="uk-text-primary"><?= $this->cms->user($last->user_id, 'nickname') ?></span>
                      <?php endforeach ?>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <?php endforeach ?>
          </div>
          <div class="uk-width-1-4@m uk-visible@m">
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="fas fa-book-open"></i> <?= lang('latest_activity') ?></h5>
              </div>
              <div class="uk-card-body">
                <ul class="uk-list uk-list-divider uk-text-small">
                  <?php foreach ($this->forum_topics->latest() as $topic): ?>
                  <li>
                    <i class="fas fa-file-alt"></i> <a href="<?= site_url('forum/topic/'.$topic->id) ?>"><?= character_limiter(html_escape($topic->title), 25) ?></a>
                    <span class="uk-text-muted uk-display-block"><?= date('d-m-y h:i', strtotime($topic->created_at)) ?></span>
                  </li>
                  <?php endforeach ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-margin-small">
          <div class="uk-card-header">
            <h5 class="uk-h5 uk-text-bold"><i class="fas fa-users"></i> <?= lang('whos_online') ?></h5>
          </div>
          <div class="uk-card-body">
            <p class="uk-margin-remove">0 users active in the past 15 minutes (0 members, 0 of whom are invisible, and 0 guests).</p>
            <hr class="uk-hr uk-margin">
            <div class="uk-grid uk-grid-medium uk-child-width-auto uk-flex-center" data-uk-grid>
              <div>
                <div class="forum-who-icon"><i class="far fa-comments fa-lg"></i></div>
                <div class="forum-who-text">
                  <span class="uk-text-bold uk-text-primary"><?= $total_posts ?></span><br>
                  <span><?= lang('posts') ?></span>
                </div>
              </div>
              <div>
              <div class="forum-who-icon"><i class="far fa-file-alt fa-lg"></i></div>
                <div class="forum-who-text">
                  <span class="uk-text-bold uk-text-primary"><?= $total_topics ?></span><br>
                  <span><?= lang('topics') ?></span>
                </div>
              </div>
              <div>
                <div class="forum-who-icon"><i class="far fa-user fa-lg"></i></div>
                <div class="forum-who-text">
                  <span class="uk-text-bold uk-text-primary"><?= $total_users ?></span><br>
                  <span><?= lang('users') ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
