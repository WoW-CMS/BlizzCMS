<?php
if (isset($_POST['button_editTopic'])):
  $title = $_POST['edit_title'];
  $description = $_POST['edit_description'];

  if (isset($_POST['topic_locked']))
    $locked = '1';
  else
    $locked = '0';

  if (isset($_POST['topic_pinned']))
    $pinned = '1';
  else
    $pinned = '0';

  $this->forum_model->updateTopic($idlink, $title, $description, $locked, $pinned);
endif;

if (isset($_POST['button_removecomment'])):
    $this->forum_model->removeComment($_POST['button_removecomment'], $idlink);
endif; ?>

    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-margin-remove-top uk-margin-small-bottom">
          <div class="uk-grid uk-grid-small" data-uk-grid>
            <div class="uk-width-expand">
              <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><span uk-icon="icon: comments; ratio: 1.5"></span>&nbsp;<?= $this->forum_model->getSpecifyPostName($idlink); ?></h4>
            </div>
            <div class="uk-width-auto">
              <?php if($this->wowauth->isLogged()): ?>
              <?php if($this->forum_model->getSpecifyPostAuthor($idlink) == $this->session->userdata('wow_sess_id')): ?>
              <div class="uk-text-center uk-text-right@s">
                <a href="#" class="uk-button uk-button-default uk-button-small" uk-toggle="target: #editTopic"><i class="far fa-edit"></i> <?= $this->lang->line('button_edit_topic'); ?></a>
              </div>
              <?php endif; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="uk-grid uk-grid-medium uk-grid-divider uk-child-width-1-1" data-uk-grid>
          <div>
            <div class="uk-grid uk-grid-medium" data-uk-grid>
              <div class="uk-width-auto">
                  <?php if($this->wowauth->getRank($this->forum_model->getSpecifyPostAuthor($idlink)) > 0): ?>
                  <div class="topic-author topic-staff-author">
                  <?php else: ?>
                  <div class="topic-author">
                  <?php endif; ?>
                    <div class="topic-author-avatar">
                      <?php if($this->wowgeneral->getUserInfoGeneral($this->forum_model->getSpecifyPostAuthor($idlink))->num_rows()): ?>
                      <img src="<?= base_url('assets/images/profiles/').$this->wowauth->getNameAvatar($this->wowauth->getImageProfile($this->forum_model->getSpecifyPostAuthor($idlink))); ?>" alt="" />
                      <?php else: ?>
                      <img src="<?= base_url('assets/images/profiles/default.png'); ?>" alt="" />
                      <?php endif; ?>
                    </div>
                    <div class="topic-author-details">
                      <p class="uk-h5 uk-margin-small-bottom"><?= $this->wowauth->getUsernameID($this->forum_model->getSpecifyPostAuthor($idlink)); ?></p>
                      <p class="uk-margin-remove uk-text-meta"><?= $this->forum_model->getCountPostAuthor($this->forum_model->getSpecifyPostAuthor($idlink)); ?> <?= $this->lang->line('forum_post_count'); ?></p>
                      <?php if($this->wowauth->getRank($this->forum_model->getSpecifyPostAuthor($idlink)) > 0): ?>
                      <p class="uk-margin-remove staff-rank">STAFF</p>
                      <?php endif; ?>
                    </div>
                  </div>
              </div>
              <div class="uk-width-expand">
                <p class="uk-text-meta uk-margin-small"><?= date('F d Y - H:i A', $this->forum_model->getSpecifyPostDate($idlink)); ?></p>
                <?php if($this->wowauth->getRank($this->forum_model->getSpecifyPostAuthor($idlink)) > 0): ?>
                <div class="uk-text-break">
                  <?= $this->forum_model->getSpecifyPostContent($idlink); ?>
                </div>
                <?php else: ?>
                <div class="uk-text-break">
                  <?= $this->forum_model->getSpecifyPostContent($idlink); ?>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php foreach ($this->forum_model->getComments($idlink)->result() as $commentss): ?>
          <div>
            <div class="uk-grid uk-grid-medium" data-uk-grid>
              <div class="uk-width-auto">
                <?php if($this->wowauth->getRank($commentss->author) > 0): ?>
                <div class="topic-author topic-staff-author">
                <?php else: ?>
                <div class="topic-author">
                <?php endif; ?>
                <div class="topic-author-avatar">
                  <?php if($this->wowgeneral->getUserInfoGeneral($commentss->author)->num_rows()): ?>
                  <img src="<?= base_url('assets/images/profiles/'.$this->wowauth->getNameAvatar($this->wowauth->getImageProfile($commentss->author))); ?>" alt="" />
                  <?php else: ?>
                  <img src="<?= base_url('assets/images/profiles/default.png'); ?>" alt="" />
                  <?php endif; ?>
                </div>
                <div class="topic-author-details">
                  <p class="uk-h5 uk-margin-small-bottom"><?= $this->wowauth->getUsernameID($commentss->author); ?></p>
                  <p class="uk-margin-remove uk-text-meta"><?= $this->forum_model->getCountPostAuthor($commentss->author); ?> <?= $this->lang->line('forum_post_count'); ?></p>
                  <?php if($this->wowauth->getRank($commentss->author) > 0): ?>
                  <p class="uk-margin-remove staff-rank">STAFF</p>
                  <?php endif; ?>
                </div>
                </div>
              </div>
              <div class="uk-width-expand">
                <p class="uk-text-meta uk-margin-small"><?= date('F d Y - H:i A', $commentss->date); ?></p>
              <?php if($this->wowauth->getRank($commentss->author) > 0): ?>
              <div class="uk-text-break">
              <?php else: ?>
              <div class="uk-text-break">
              <?php endif; ?>
                <?= $commentss->commentary ?>
              </div>
              <?php if($this->wowauth->getRank($this->session->userdata('wow_sess_id')) > 0 || $this->session->userdata('wow_sess_id') == $commentss->author && $this->wowgeneral->getTimestamp() < strtotime('+30 minutes', $commentss->date)): ?>
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
          <?php if(!$this->wowauth->isLogged() && $this->forum_model->getTopicLocked($idlink) == 0): ?>
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
          <?php if($this->forum_model->getTopicLocked($idlink) == 1): ?>
          <div>
            <!-- locked -->
            <div class="glass-box">
              <h1 class="glass-box-title uk-text-center"><span uk-icon="icon: lock; ratio: 2"></span> <?= $this->lang->line('forum_not_authorized'); ?></h1>
              <div class="glass-box-container">
                <p class="uk-margin-small"><?= $this->lang->line('forum_topic_locked'); ?></p>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <?php if($this->wowauth->isLogged() && $this->forum_model->getTopicLocked($idlink) == 0): ?>
          <div>
            <!-- comment login -->
            <div class="glass-box">
              <h1 class="glass-box-title uk-text-center"><span uk-icon="icon: comment; ratio: 2"></span> <?= $this->lang->line('forum_comment_header'); ?></h1>
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-1-5@s"></div>
                <div class="uk-width-3-5@s">
                  <?= form_open('', 'id="topicreplyForm" onsubmit="TopicReplyForm(event)"'); ?>
                  <div class="uk-margin-small uk-light">
                    <textarea class="uk-textarea tinyeditor" id="reply_comment" rows="10"></textarea>
                  </div>
                  <div class="uk-margin-small">
                    <button class="uk-button uk-button-default uk-width-1-1" type="submit" id="button_reply"><i class="fas fa-reply"></i> <?= $this->lang->line('button_add_reply'); ?></button>
                  </div>
                  <?= form_close(); ?>
                </div>
                <div class="uk-width-1-5@s"></div>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
    <?= $tiny ?>
    <script>
      function TopicReplyForm(e) {
        e.preventDefault();

        var topic = "<?= $idlink ?>";
        var reply = tinymce.get('reply_comment').getContent();
        var content = tinymce.get('reply_comment').getContent({format: 'text'}).replace('&nbsp;','').trim();
        if(content == "" || content == null || content == '<p> </p>'){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: '<?= $this->lang->line('notification_select_priority'); ?>',
              info: '',
              icon: 'fas fa-times-circle'
            },
            'delay': 5000,
            'position': 'top right',
            'inEffect': 'slideRight',
            'outEffect': 'slideRight'
          });
          return false;
        }
        $.ajax({
          url:"<?= base_url($lang.'/forum/topic/reply'); ?>",
          method:"POST",
          data:{topic, reply},
          dataType:"text",
          beforeSend: function(){
            $.amaran({
              'theme': 'awesome info',
              'content': {
                title: '<?= $this->lang->line('notification_title_info'); ?>',
                message: '<?= $this->lang->line('notification_checking'); ?>',
                info: '',
                icon: 'fas fa-sign-in-alt'
              },
              'delay': 5000,
              'position': 'top right',
              'inEffect': 'slideRight',
              'outEffect': 'slideRight'
            });
          },
          success:function(response){
            if(!response)
              alert(response);

            if (response) {
              $.amaran({
                'theme': 'awesome ok',
                  'content': {
                  title: '<?= $this->lang->line('notification_title_success'); ?>',
                  message: '<?= $this->lang->line('notification_report_created'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#topicreplyForm')[0].reset();
            window.location.replace("<?= base_url($lang.'/forum/topic/'.$idlink); ?>");
          }
        });
      }
    </script>
