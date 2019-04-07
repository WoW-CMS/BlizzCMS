<?php
if (isset($_POST['button_addcommentary'])):
  $commentary = $_POST['reply_comment'];

  if (!is_null($commentary) && !empty($commentary) && $commentary != '' && $commentary != ' ')
    $idsession = $this->session->userdata('wow_sess_id');
    $this->news_model->insertComment($commentary, $idlink, $idsession);
endif;

if (isset($_POST['button_removecomment'])):
  $this->news_model->removeComment($_POST['button_removecomment'], $idlink);
endif; ?>

    <?= $tiny ?>
    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-margin-remove-top uk-margin-small-bottom">
          <div class="uk-grid uk-grid-small" data-uk-grid>
            <div class="uk-width-expand">
              <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-newspaper"></i> <?= $this->news_model->getNewTitle($idlink); ?></h4>
            </div>
            <div class="uk-width-auto">
              <p class="uk-text-small"><i class="far fa-clock"></i> <?= date('F j, Y, h:i a', $this->news_model->getNewlogDate($idlink)); ?></p>
            </div>
          </div>
        </div>
        <article class="uk-article">
          <div class="uk-card uk-card-default uk-card-body uk-margin-small">
            <?= $this->news_model->getNewDescription($idlink); ?>
          </div>
          <div class="uk-grid uk-grid-medium uk-grid-divider uk-child-width-1-1" data-uk-grid>
            <?php foreach($this->news_model->getComments($idlink)->result() as $commentss): ?>
            <div>
              <div class="uk-grid uk-grid-medium" data-uk-grid>
                <div class="uk-width-auto">
                  <?php if($this->m_data->getRank($commentss->author) > 0): ?>
                  <div class="topic-author topic-staff-author">
                  <?php else: ?>
                  <div class="topic-author">
                  <?php endif; ?>
                  <div class="topic-author-avatar">
                    <?php if($this->m_general->getUserInfoGeneral($commentss->author)->num_rows()): ?>
                    <img src="<?= base_url('includes/images/profiles/'.$this->m_data->getNameAvatar($this->m_data->getImageProfile($commentss->author))); ?>" alt="" />
                    <?php else: ?>
                    <img src="<?= base_url('includes/images/profiles/default.png'); ?>" alt="" />
                    <?php endif; ?>
                  </div>
                  <div class="topic-author-details">
                    <p class="uk-margin-small-bottom"><?= $this->m_data->getUsernameID($commentss->author); ?></p>
                    <?php if($this->m_data->getRank($commentss->author) > 0): ?>
                    <p class="uk-margin-remove staff-rank">STAFF</p>
                    <?php endif; ?>
                  </div>
                  </div>
                </div>
                <div class="uk-width-expand">
                  <p class="uk-text-meta uk-margin-small"><?= date('F d Y - H:i A', $commentss->date); ?></p>
                <?php if($this->m_data->getRank($commentss->author) > 0): ?>
                <div class="uk-text-break" style="color: #<?= $this->config->item('staff_forum_color'); ?>;">
                <?php else: ?>
                <div class="uk-text-break" style="color: white;">
                <?php endif; ?>
                  <?= $commentss->commentary ?>
                </div>
                <?php if($this->m_data->getRank($this->session->userdata('wow_sess_id')) > 0 || $this->session->userdata('wow_sess_id') == $commentss->author && $this->m_data->getTimestamp() < strtotime('+30 minutes', $commentss->date)): ?>
                  <form action="" method="post" accept-charset="utf-8">
                    <div class="uk-margin-small-top uk-margin-remove-bottom">
                      <button name="button_removecomment" type="submit" value="<?= $commentss->id ?>" class="uk-button uk-button-danger uk-button-small"><i class="fas fa-eraser"></i> <?= $this->lang->line('button_remove'); ?></button>
                    </div>
                  </form>
                <?php endif; ?>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
            <?php if(!$this->m_data->isLogged() && $this->forum_model->getTopicLocked($idlink) == 0): ?>
            <div>
              <!-- isn't login -->
              <div class="glass-box">
                <h1 class="glass-box-title uk-text-center"><span uk-icon="icon: comment; ratio: 2"></span> <?= $this->lang->line('forum_comment_header'); ?></h1>
                <div class="glass-box-container">
                  <p class="uk-margin-small"><?= $this->lang->line('forum_comment_locked'); ?></p>
                  <a href="<?= base_url('login'); ?>" class="uk-button uk-button-default uk-width-1-2 uk-width-1-4@m"><i class="fas fa-sign-in-alt"></i> <?= $this->lang->line('button_login'); ?></a>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <?php if($this->m_data->isLogged()): ?>
            <div>
              <!-- comment login -->
              <div class="glass-box">
                <h1 class="glass-box-title uk-text-center"><span uk-icon="icon: comment; ratio: 2"></span> <?= $this->lang->line('forum_comment_header'); ?></h1>
                <form class="glass-box-editor" method="post" action="" data-post-form="true" accept-charset="utf-8">
                  <div class="uk-margin-small uk-light">
                    <textarea class="uk-textarea tinyeditor" tabindex="1" spellcheck="true" name="reply_comment" rows="10" cols="80"></textarea>
                  </div>
                  <div class="uk-margin-small">
                    <button class="uk-button uk-button-default uk-width-1-1" type="submit" name="button_addcommentary" id="submit-button"><i class="fas fa-reply"></i> <?= $this->lang->line('button_add_reply'); ?></button>
                  </div>
                </form>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </article>
      </div>
    </section>
