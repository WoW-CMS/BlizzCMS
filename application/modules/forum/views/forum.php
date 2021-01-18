    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('forum'); ?></h4>
          </div>
          <div class="uk-width-auto">
            <?php if ($this->website->isLogged()): ?>
            <a href="<?= site_url('forum/view/'.$forum->id.'/create'); ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-pencil-alt"></i> <?= lang('new_topic'); ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <?= $template['partials']['alerts']; ?>
        <div class="uk-margin-remove-top uk-margin-small-bottom">
          <div class="uk-grid uk-grid-small" data-uk-grid>
            <div class="uk-width-expand">
              <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-list"></i> <?= html_escape($forum->name); ?></h4>
            </div>
            <div class="uk-width-auto"></div>
          </div>
        </div>
        <p class="uk-text-uppercase uk-text-bold uk-margin-small"><?= lang('topic_list'); ?></p>
        <div class="uk-overflow-auto uk-margin-small">
          <table class="uk-table dark-table uk-table-divider uk-table-hover uk-table-middle">
            <tbody>
              <?php foreach($topics as $topic): ?>
              <tr>
                <td class="uk-table-shrink uk-table-link">
                  <a href="<?= site_url('forum/topic/'.$topic->id); ?>">
                    <span uk-icon="icon: comments"></span>
                  </a>
                </td>
                <td class="uk-table-expand uk-table-link uk-text-break">
                  <a href="<?= site_url('forum/topic/'.$topic->id); ?>" class="uk-link-reset">
                    <?= html_escape($topic->title); ?>
                  </a>
                </td>
                <td class="uk-width-small uk-text-center">
                  <span uk-icon="icon: commenting; ratio: 0.9"></span>&nbsp;<?= $this->forum_model->count_posts($topic->id); ?>
                </td>
                <td class="uk-width-small uk-text-center">
                  <?php if ($this->auth->get_gmlevel($topic->user_id) > 0): ?>
                  <span class="topic-forum-staff"><?= $this->website->get_user($topic->user_id, 'nickname'); ?></span>
                  <?php else: ?>
                  <span class="topic-forum-member"><?= $this->website->get_user($topic->user_id, 'nickname'); ?></span>
                  <?php endif; ?>
                </td>
                <td class="uk-width-small uk-text-center uk-text-meta"><?= date('d-m-Y', $topic->created_at); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
