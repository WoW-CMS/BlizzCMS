    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-margin-remove-top uk-margin-small-bottom">
          <div class="uk-grid uk-grid-small" data-uk-grid>
            <div class="uk-width-expand">
              <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-list"></i> <?= $this->forum_model->getCategoryName($idlink); ?></h4>
            </div>
            <div class="uk-width-auto">
              <?php if($this->wowauth->isLogged()): ?>
              <div class="uk-text-center uk-text-right@s">
                <a href="<?= base_url('forum/topic/new/'.$idlink); ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-pencil-alt"></i> <?= $this->lang->line('button_new_topic'); ?></a>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <p class="uk-text-uppercase uk-text-bold uk-margin-small"><?= $this->lang->line('forum_topic_list'); ?></p>
        <div class="uk-overflow-auto uk-margin-small">
          <table class="uk-table dark-table uk-table-hover uk-table-middle">
            <tbody>
              <?php foreach($this->forum_model->getSpecifyCategoryPostsPined($idlink)->result() as $lists): ?>
              <tr>
                <td class="uk-table-shrink uk-table-link">
                  <a href="<?= base_url('forum/topic/'.$lists->id); ?>" class="topic-forum-staff">
                    <span uk-icon="icon: bolt;ratio: 1.5"></span>
                  </a>
                </td>
                <td class="uk-table-expand uk-table-link uk-text-break">
                  <a href="<?= base_url('forum/topic/'.$lists->id); ?>" class="uk-link-reset">
                    <?= $lists->title; ?>
                  </a>
                </td>
                <td class="uk-width-small uk-text-center">
                  <span uk-icon="icon: commenting; ratio: 0.9"></span>&nbsp;<?= $this->forum_model->getComments($lists->id)->num_rows(); ?>
                </td>
                <td class="uk-width-small uk-text-center">
                  <?php if($this->wowauth->getRank($lists->author) > 0): ?>
                  <span class="topic-forum-staff"><?= $this->wowauth->getUsernameID($lists->author); ?></span>
                  <?php else: ?>
                  <span class="topic-forum-member"><?= $this->wowauth->getUsernameID($lists->author); ?></span>
                  <?php endif; ?>
                </td>
                <td class="uk-width-small uk-text-center uk-text-meta"><?= date('d-m-Y', $lists->date); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="uk-overflow-auto uk-margin-small">
          <table class="uk-table dark-table uk-table-divider uk-table-hover uk-table-middle">
            <tbody>
              <?php foreach($this->forum_model->getSpecifyCategoryPosts($idlink)->result() as $lists): ?>
              <tr>
                <td class="uk-table-shrink uk-table-link">
                  <a href="<?= base_url('forum/topic/'.$lists->id); ?>">
                    <span uk-icon="icon: comments"></span>
                  </a>
                </td>
                <td class="uk-table-expand uk-table-link uk-text-break">
                  <a href="<?= base_url('forum/topic/'.$lists->id); ?>" class="uk-link-reset">
                    <?= $lists->title; ?>
                  </a>
                </td>
                <td class="uk-width-small uk-text-center">
                  <span uk-icon="icon: commenting; ratio: 0.9"></span>&nbsp;<?= $this->forum_model->getComments($lists->id)->num_rows(); ?>
                </td>
                <td class="uk-width-small uk-text-center">
                  <?php if($this->wowauth->getRank($lists->author) > 0): ?>
                  <span class="topic-forum-staff"><?= $this->wowauth->getUsernameID($lists->author); ?></span>
                  <?php else: ?>
                  <span class="topic-forum-member"><?= $this->wowauth->getUsernameID($lists->author); ?></span>
                  <?php endif; ?>
                </td>
                <td class="uk-width-small uk-text-center uk-text-meta"><?= date('d-m-Y', $lists->date); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
