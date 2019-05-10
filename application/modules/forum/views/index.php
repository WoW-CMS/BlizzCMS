    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium uk-margin-small" data-uk-grid>
          <div class="uk-width-3-4@m">
            <?php foreach($this->forum_model->getCategory() as $categorys): ?>
            <div class="uk-overflow-auto uk-margin-medium forum-table">
              <table class="uk-table uk-table-hover uk-table-middle">
                <caption uk-toggle="target: #cat-<?= $categorys->id ?>;animation: uk-animation-fade"><i class="fas fa-bookmark"></i> <?= $categorys->name ?></caption>
                <tbody id="cat-<?= $categorys->id ?>">
                  <?php foreach($this->forum_model->getCategoryForums($categorys->id) as $sections): ?>
                  <?php if ($sections->type == 1 || $sections->type == 3): ?>
                  <tr>
                    <td class="uk-table-shrink">
                      <i class="forum-icon" style="background-image: url('<?= base_url('assets/images/forums/'.$sections->icon); ?>')"></i>
                    </td>
                    <td class="uk-table-expand uk-table-link uk-text-break">
                      <a href="<?= base_url('forum/category/'.$sections->id); ?>" class="uk-link-reset">
                        <h4 class="uk-h4 uk-margin-remove"><?= $sections->name ?></h4>
                        <span class="uk-text-meta"><?= $sections->description ?></span>
                      </a>
                    </td>
                    <td class="uk-width-small uk-text-center">
                      <span class="uk-display-block uk-text-bold"><i class="far fa-file-alt"></i> <?= $this->forum_model->getCountPostCategory($sections->id) ?></span>
                      <span class="uk-text-small"><?= $this->lang->line('forum_posts_count'); ?></span>
                    </td>
                    <td class="uk-width-medium">
                      <?php foreach ($this->forum_model->getLastPostCategory($sections->id)->result() as $lastpost): ?>
                        <a href="<?= base_url('forum/topic/'.$lastpost->id) ?>" class="uk-display-block"><?= $lastpost->title ?></a>
                        <span class="uk-text-meta uk-display-block"><?= date('d-m-y h:i:s', $lastpost->date) ?></span>
                        by <span class="uk-text-primary"><?= $this->wowauth->getUsernameID($lastpost->author) ?></span>
                      <?php endforeach; ?>
                    </td>
                  </tr>
                  <?php elseif($sections->type == 2): ?>
                  <?php if($this->wowauth->isLogged()): ?>
                  <?php if($this->wowauth->getRank($this->session->userdata('wow_sess_id')) > 0): ?>
                  <tr>
                    <td class="uk-table-shrink">
                      <i class="forum-icon" style="background-image: url('<?= base_url('assets/images/forums/'.$sections->icon); ?>')"></i>
                    </td>
                    <td class="uk-table-expand uk-table-link uk-text-break">
                      <a href="<?= base_url('forum/category/'.$sections->id); ?>" class="uk-link-reset">
                        <h4 class="uk-h4 uk-margin-remove"><?= $sections->name ?></h4>
                        <span class="uk-text-meta"><?= $sections->description ?></span>
                      </a>
                    </td>
                    <td class="uk-width-small uk-text-center">
                      <span class="uk-display-block uk-text-bold"><?= $this->forum_model->getCountPostCategory($sections->id) ?></span>
                      <span class="uk-text-small"><?= $this->lang->line('forum_posts_count'); ?></span>
                    </td>
                    <td class="uk-width-medium">
                      <?php foreach ($this->forum_model->getLastPostCategory($sections->id)->result() as $lastpost): ?>
                        <a href="<?= base_url('forum/topic/'.$lastpost->id) ?>" class="uk-display-block"><?= $lastpost->title ?></a>
                        <span class="uk-text-meta uk-display-block"><?= date('d-m-y h:i:s', $lastpost->date) ?></span>
                        by <span class="uk-text-primary"><?= $this->wowauth->getUsernameID($lastpost->author) ?></span>
                      <?php endforeach; ?>
                    </td>
                  </tr>
                  <?php endif; ?>
                  <?php endif; ?>
                  <?php endif; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <?php endforeach; ?>
          </div>
          <div class="uk-width-1-4@m">
            <div class="uk-card uk-card-forum">
              <div class="uk-card-header">
                <h3 class="uk-card-title"><i class="fas fa-book-open"></i> <?= $this->lang->line('forum_last_activity'); ?></h3>
              </div>
              <div class="uk-card-body">
                <ul class="uk-list uk-list-divider">
                  <?php foreach ($this->forum_model->getLastPosts()->result() as $lastest): ?>
                  <li>
                    <a href="<?= base_url('forum/topic/'.$lastest->id) ?>"><?= $lastest->title ?></a>
                    <?php if($this->forum_model->getLastRepliesCount($lastest->id) == 0): ?>
                    <p class="uk-text-small uk-margin-remove"><?= $this->lang->line('forum_last_post_by'); ?> <span class="uk-text-primary"><?= $this->wowauth->getUsernameID($lastest->author) ?></span></p>
                    <p class="uk-text-small uk-margin-remove"><?= date('d-m-y h:i:s', $lastest->date) ?></p>
                    <?php else: ?>
                    <?php foreach ($this->forum_model->getLastReplies($lastest->id)->result() as $replies): ?>
                    <p class="uk-text-small uk-margin-remove"><?= $this->lang->line('forum_last_post_by'); ?> <span class="uk-text-primary"><?= $this->wowauth->getUsernameID($replies->author) ?></span></p>
                    <p class="uk-text-small uk-margin-remove"><?= date('d-m-y h:i:s', $replies->date) ?></p>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="uk-card uk-card-forum uk-margin-small">
          <div class="uk-card-header">
            <h3 class="uk-card-title"><i class="fas fa-users"></i> <?= $this->lang->line('forum_whos_online'); ?></h3>
          </div>
          <div class="uk-card-body">
            <p class="uk-margin-remove">0 users active in the past 15 minutes (0 members, 0 of whom are invisible, and 0 guests).</p>
            <hr class="uk-hr uk-margin">
            <div class="uk-grid uk-grid-medium uk-child-width-auto uk-flex-center" data-uk-grid>
              <div>
                <div class="forum-who-icon"><i class="far fa-comments fa-lg"></i></div>
                <div class="forum-who-text">
                  <span class="uk-text-bold uk-text-primary"><?= $this->forum_model->getCountPostReplies() ?></span><br>
                  <span><?= $this->lang->line('forum_replies_count'); ?></span>
                </div>
              </div>
              <div>
              <div class="forum-who-icon"><i class="far fa-file-alt fa-lg"></i></div>
                <div class="forum-who-text">
                  <span class="uk-text-bold uk-text-primary"><?= $this->forum_model->getCountPostGeneral() ?></span><br>
                  <span><?= $this->lang->line('forum_topics_count'); ?></span>
                </div>
              </div>
              <div>
                <div class="forum-who-icon"><i class="far fa-user fa-lg"></i></div>
                <div class="forum-who-text">
                  <span class="uk-text-bold uk-text-primary"><?= $this->forum_model->getCountUsers() ?></span><br>
                  <span><?= $this->lang->line('forum_users_count'); ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
