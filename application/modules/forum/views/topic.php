    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <div class="uk-grid uk-grid-small" data-uk-grid>
              <div class="uk-width-expand">
                <h4 class="uk-h4 uk-text-bold"><span uk-icon="icon: comments; ratio: 1.2"></span>&nbsp;<?= $this->forum_model->getTopicRow($idlink, 'title'); ?></h4>
              </div>
              <div class="uk-width-auto">
                <?php if($this->wowauth->isLogged()): ?>
                  <?php if($this->forum_model->getTopicRow($idlink, 'author') == $this->session->userdata('wow_sess_id')): ?>
                    <div class="uk-text-center uk-text-right@s">
                      <a href="#" class="uk-button uk-button-default uk-button-small" uk-toggle="target: #editTopic"><i class="far fa-edit"></i> <?= $this->lang->line('button_edit_topic'); ?></a>
                    </div>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="uk-card-body">
            <div class="uk-grid uk-grid-small" data-uk-grid>
              <div class="uk-width-1-6@s">
                <div class="Author <?php if($this->wowauth->getRank($this->forum_model->getTopicRow($idlink, 'author')) > 0) echo 'topic-author-staff'; ?> uk-flex uk-flex-center">
                  <div class="topic-author-avatar profile">
                    <?php if($this->wowgeneral->getUserInfoGeneral($this->forum_model->getTopicRow($idlink, 'author'))->num_rows()): ?>
                    <img src="<?= base_url('assets/images/profiles/').$this->wowauth->getNameAvatar($this->wowauth->getImageProfile($this->forum_model->getTopicRow($idlink, 'author'))); ?>" alt="" />
                    <?php else: ?>
                    <img src="<?= base_url('assets/images/profiles/default.png'); ?>" alt="" />
                    <?php endif; ?>
                  </div>
                </div>
                <p class="uk-text-bold uk-text-center uk-margin-remove"><?= $this->wowauth->getUsernameID($this->forum_model->getTopicRow($idlink, 'author')); ?></p>
                <p class="uk-margin-remove uk-text-meta uk-text-center"><?= $this->forum_model->getCountTopics('author', $this->forum_model->getTopicRow($idlink, 'author')); ?> <?= $this->lang->line('forum_post_count'); ?></p>
                <?php if($this->wowauth->getRank($this->forum_model->getTopicRow($idlink, 'author')) > 0): ?>
                <div class="author-rank-staff"><i class="fas fa-fire"></i> Staff</div>
                <?php endif; ?>
              </div>
              <div class="uk-width-expand@s">
                <p class="uk-text-small uk-text-meta uk-margin-remove"><?= date('F d Y - H:i A', $this->forum_model->getTopicRow($idlink, 'date')); ?></p>
                <?= $this->forum_model->getTopicRow($idlink, 'content'); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-margin" data-uk-grid>
          <?php foreach ($this->forum_model->getComments($idlink)->result() as $commentss): ?>
          <div>
            <div class="uk-card uk-card-default uk-card-body">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-1-6@s">
                  <div class="Author <?php if($this->wowauth->getRank($commentss->author) > 0) echo 'topic-author-staff'; ?> uk-flex uk-flex-center">
                    <div class="topic-author-avatar profile">
                      <?php if($this->wowgeneral->getUserInfoGeneral($commentss->author)->num_rows()): ?>
                      <img src="<?= base_url('assets/images/profiles/'.$this->wowauth->getNameAvatar($this->wowauth->getImageProfile($commentss->author))); ?>" alt="" />
                      <?php else: ?>
                      <img src="<?= base_url('assets/images/profiles/default.png'); ?>" alt="" />
                      <?php endif; ?>
                    </div>
                  </div>
                  <p class="uk-text-bold uk-text-center uk-margin-remove"><?= $this->wowauth->getUsernameID($commentss->author); ?></p>
                  <p class="uk-margin-remove uk-text-meta uk-text-center"><?= $this->lang->line('forum_post_count'); ?></p>
                  <?php if($this->wowauth->getRank($commentss->author) > 0): ?>
                <div class="author-rank-staff"><i class="fas fa-fire"></i> Staff</div>
                  <?php endif; ?>
                </div>
                <div class="uk-width-expand@s">
                  <p class="uk-text-small uk-text-meta uk-margin-remove"><?= date('F d Y - H:i A', $commentss->date); ?></p>
                  <?= $commentss->commentary ?>
                  <?php if($this->wowauth->getRank($this->session->userdata('wow_sess_id')) > 0 || $this->session->userdata('wow_sess_id') == $commentss->author && $this->wowgeneral->getTimestamp() < strtotime('+30 minutes', $commentss->date)): ?>
                  <div class="uk-margin-small-top uk-margin-remove-bottom">
                    <button class="uk-button uk-button-danger uk-button-small" value="<?= $commentss->id ?>" id="button_delete<?= $commentss->id ?>" onclick="DeleteTopicReply(event, this.value)"><i class="fas fa-eraser"></i> <?= $this->lang->line('button_remove'); ?></button>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
          <?php if(!$this->wowauth->isLogged() && $this->forum_model->getTopicRow($idlink, 'locked') == 0): ?>
          <div>
            <div class="uk-card uk-card-default uk-card-body">
              <h3 class="uk-h3 uk-text-center"><span uk-icon="icon: comment; ratio: 1.5"></span> <?= $this->lang->line('forum_comment_header'); ?></h3>
              <div class="glass-box-container">
                <p class="uk-margin-small"><?= $this->lang->line('forum_comment_locked'); ?></p>
                <a href="<?= base_url('login'); ?>" class="uk-button uk-button-default uk-width-1-2 uk-width-1-3@m"><i class="fas fa-sign-in-alt"></i> <?= $this->lang->line('button_login'); ?></a>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <?php if($this->forum_model->getTopicRow($idlink, 'locked') == 1): ?>
          <div>
            <div class="uk-card uk-card-default uk-card-body">
              <h3 class="uk-h3 uk-text-center"><span uk-icon="icon: lock; ratio: 1.5"></span> <?= $this->lang->line('forum_not_authorized'); ?></h3>
              <div class="glass-box-container">
                <p class="uk-margin-small"><?= $this->lang->line('forum_topic_locked'); ?></p>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <?php if($this->wowauth->isLogged() && $this->forum_model->getTopicRow($idlink, 'locked') == 0): ?>
          <div>
            <div class="uk-card uk-card-default uk-card-body">
              <h3 class="uk-h3 uk-text-center"><span uk-icon="icon: comment; ratio: 1.5"></span> <?= $this->lang->line('forum_comment_header'); ?></h3>
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-1-6@s"></div>
                <div class="uk-width-2-3@s">
                  <?= form_open('', 'id="topicreplyForm" onsubmit="TopicReplyForm(event)"'); ?>
                  <div class="uk-margin-small uk-light">
                    <textarea class="uk-textarea tinyeditor" id="reply_comment" rows="10"></textarea>
                  </div>
                  <div class="uk-margin-small">
                    <button class="uk-button uk-button-default uk-width-1-1" type="submit" id="button_reply"><i class="fas fa-reply"></i> <?= $this->lang->line('button_add_reply'); ?></button>
                  </div>
                  <?= form_close(); ?>
                </div>
                <div class="uk-width-1-6@s"></div>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
    <?php if($this->wowauth->isLogged()): ?>
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
              message: '<?= $this->lang->line('notification_reply_empty'); ?>',
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
                  message: '<?= $this->lang->line('notification_reply_created'); ?>',
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
            window.location.replace("<?= base_url('forum/topic/'.$idlink); ?>");
          }
        });
      }
      function DeleteTopicReply(e, value) {
        e.preventDefault();

        $.ajax({
          url:"<?= base_url($lang.'/forum/topic/reply/delete'); ?>",
          method:"POST",
          data:{value},
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
                  message: '<?= $this->lang->line('notification_reply_deleted'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            window.location.replace("<?= base_url('forum/topic/'.$idlink); ?>");
          }
        });
      }
    </script>
    <?php endif; ?>
