    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-margin-remove-top uk-margin-small-bottom">
          <div class="uk-grid uk-grid-small" data-uk-grid>
            <div class="uk-width-expand">
              <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-list"></i> <?= $this->forum_model->getForumRow($idlink, 'name'); ?></h4>
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
          <?php foreach($this->forum_model->getPosts($idlink)->result() as $lists): ?>
            <tbody>
              <tr>
                <td class="uk-table-shrink uk-table-link">
                  <a href="<?= base_url('forum/topic/'.$lists->id); ?>" class="topic-forum-staff">
                    <span uk-icon="icon: bolt;ratio: 1.5"></span>
                  </a>
                </td>
                <td class="uk-table-expand uk-table-link uk-text-break">
                  <a href="<?= base_url('forum/topic/'.$lists->id); ?>" class="uk-link-reset">
                    <?php if ($lists->pinned == '1') { ?>
                      <i class="fas fa-link"></i> <?= $lists->title; ?>
                    <?php } else { ?>
                      <?= $lists->title; ?>
                    <?php } ?> 
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
            </tbody>
            <?php endforeach; ?>
          </table>
        </div>
    </section>