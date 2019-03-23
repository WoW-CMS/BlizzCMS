    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-3-4@m">
            <?php foreach($this->forum_model->getCategory() as $categorys): ?>
            <div class="uk-overflow-auto uk-margin-medium forum-table">
              <table class="uk-table uk-table-hover uk-table-middle">
                <caption uk-toggle="target: #cat-<?= $categorys->id ?>;animation: uk-animation-fade"><i class="fas fa-bookmark"></i> <?= $categorys->categoryName ?></caption>
                <tbody id="cat-<?= $categorys->id ?>">
                  <?php foreach($this->forum_model->getCategoryForums($categorys->id) as $sections): ?>
                  <?php if ($sections->type == 1 || $sections->type == 3): ?>
                  <tr>
                    <td class="uk-table-shrink">
                      <i class="forum-icon" style="background-image: url('<?= base_url('includes/images/forums/'.$sections->icon); ?>')"></i>
                    </td>
                    <td class="uk-table-expand uk-table-link uk-text-break">
                      <a href="<?= base_url('forum/category/'.$sections->id); ?>" class="uk-link-reset">
                        <h4 class="uk-h4 uk-margin-remove"><?= $sections->name ?></h4>
                        <span class="uk-text-meta"><?= $sections->description ?></span>
                      </a>
                    </td>
                    <td class="uk-width-small uk-text-center">
                      <span class="uk-display-block uk-text-bold">100</span>
                      <span class="uk-text-small">Post</span>
                    </td>
                    <td class="uk-width-medium">
                      <a href="" class="uk-display-block">[Dev] Icecrown Citadel...</a>
                      <span class="uk-text-meta uk-display-block">03-22-2019, 08:14 AM</span>
                      by <span class="uk-text-primary">Username</span>
                    </td>
                  </tr>
                  <?php elseif($sections->type == 2): ?>
                  <?php if($this->m_data->isLogged()): ?>
                  <?php if($this->m_data->getRank($this->session->userdata('fx_sess_id')) > 0): ?>
                  <tr>
                    <td class="uk-table-shrink">
                      <i class="forum-icon" style="background-image: url('<?= base_url('includes/images/forums/'.$sections->icon); ?>')"></i>
                    </td>
                    <td class="uk-table-expand uk-table-link uk-text-break">
                      <a href="<?= base_url('forum/category/'.$sections->id); ?>" class="uk-link-reset">
                        <h4 class="uk-h4 uk-margin-remove"><?= $sections->name ?></h4>
                        <span class="uk-text-meta"><?= $sections->description ?></span>
                      </a>
                    </td>
                    <td class="uk-width-small uk-text-center">
                      <span class="uk-display-block uk-text-bold">100</span>
                      <span class="uk-text-small">Post</span>
                    </td>
                    <td class="uk-width-medium">
                      <a href="" class="uk-display-block">[Dev] Icecrown Citadel...</a>
                      <span class="uk-text-meta uk-display-block">03-22-2019, 08:14 AM</span>
                      by <span class="uk-text-primary">Username</span>
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
                <h3 class="uk-card-title"><i class="fas fa-book-open"></i> Latest activity</h3>
              </div>
              <div class="uk-card-body">
                <ul class="uk-list uk-list-divider">
                  <li>
                    <a href="">Lorem ipsum dolor sit amet, consectetur</a>
                    <p class="uk-text-small uk-margin-remove">Last Post by <span class="uk-text-primary">Username</span></p>
                    <p class="uk-text-small uk-margin-remove">03-21-2019, 10:49 PM</p>
                  </li>
                  <li>
                    <a href="">Lorem ipsum dolor sit amet, consectetur</a>
                    <p class="uk-text-small uk-margin-remove">Last Post by <span class="uk-text-primary">Username</span></p>
                    <p class="uk-text-small uk-margin-remove">03-21-2019, 10:49 PM</p>
                  </li>
                  <li>
                    <a href="">Lorem ipsum dolor sit amet, consectetur</a>
                    <p class="uk-text-small uk-margin-remove">Last Post by <span class="uk-text-primary">Username</span></p>
                    <p class="uk-text-small uk-margin-remove">03-21-2019, 10:49 PM</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="uk-card uk-card-forum uk-margin-small">
          <div class="uk-card-header">
            <h3 class="uk-card-title"><i class="fas fa-users"></i> Who's Online</h3>
          </div>
          <div class="uk-card-body">
            <p class="uk-margin-remove">0 users active in the past 15 minutes (0 members, 0 of whom are invisible, and 0 guests).</p>
            <hr class="uk-hr uk-margin">
            <div class="uk-grid uk-grid-medium uk-child-width-auto uk-flex-center" data-uk-grid>
              <div>
                <div class="forum-who-icon"><i class="far fa-comments fa-lg"></i></div>
                <div class="forum-who-text">
                  <span class="uk-text-bold uk-text-primary">50</span><br>
                  <span>Replies</span>
                </div>
              </div>
              <div>
              <div class="forum-who-icon"><i class="far fa-file-alt fa-lg"></i></div>
                <div class="forum-who-text">
                  <span class="uk-text-bold uk-text-primary">50</span><br>
                  <span>Topics</span>
                </div>
              </div>
              <div>
                <div class="forum-who-icon"><i class="far fa-user fa-lg"></i></div>
                <div class="forum-who-text">
                  <span class="uk-text-bold uk-text-primary">50</span><br>
                  <span>Users</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
