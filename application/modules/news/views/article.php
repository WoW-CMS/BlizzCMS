    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-margin-remove-top uk-margin-small-bottom">
          <div class="uk-grid uk-grid-small" data-uk-grid>
            <div class="uk-width-expand@s">
              <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-newspaper"></i> <?= $this->news_model->getNewTitle($idlink); ?></h4>
            </div>
            <div class="uk-width-auto@s">
              <p class="uk-text-small"><i class="far fa-clock"></i> <?= date('F j, Y, h:i a', $this->news_model->getNewlogDate($idlink)); ?></p>
            </div>
          </div>
        </div>
        <article class="uk-article">
          <div class="uk-card uk-card-default uk-card-body uk-margin-small">
            <?= $this->news_model->getNewDescription($idlink); ?>
          </div>
          <div class="uk-grid uk-grid-medium uk-grid-divider uk-child-width-1-1 uk-margin" data-uk-grid>
            <?php foreach($this->news_model->getComments($idlink)->result() as $commentss): ?>
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
                    <p class="uk-margin-small-bottom"><?= $this->wowauth->getUsernameID($commentss->author); ?></p>
                    <?php if($this->wowauth->getRank($commentss->author) > 0): ?>
                    <p class="uk-margin-remove staff-rank">STAFF</p>
                    <?php endif; ?>
                  </div>
                  </div>
                </div>
                <div class="uk-width-expand">
                  <p class="uk-text-meta uk-margin-small"><?= date('F d Y - H:i A', $commentss->date); ?></p>
                <?php if($this->wowauth->getRank($commentss->author) > 0): ?>
                <div class="uk-text-break" style="color: #<?= $this->config->item('staff_forum_color'); ?>;">
                <?php else: ?>
                <div class="uk-text-break" style="color: white;">
                <?php endif; ?>
                  <?= $commentss->commentary ?>
                </div>
                <?php if($this->wowauth->getRank($this->session->userdata('wow_sess_id')) > 0 || $this->session->userdata('wow_sess_id') == $commentss->author && $this->wowgeneral->getTimestamp() < strtotime('+30 minutes', $commentss->date)): ?>
                <div class="uk-margin-small-top uk-margin-remove-bottom">
                  <button class="uk-button uk-button-danger uk-button-small" value="<?= $commentss->id ?>" id="button_delete<?= $commentss->id ?>" onclick="DeleteReply(event, this.value)"><i class="fas fa-eraser"></i> <?= $this->lang->line('button_remove'); ?></button>
                </div>
                <?php endif; ?>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
            <?php if(!$this->wowauth->isLogged() && $this->forum_model->getTopicLocked($idlink) == 0): ?>
            <div>
              <div class="glass-box">
                <h1 class="glass-box-title uk-text-center"><span uk-icon="icon: comment; ratio: 2"></span> <?= $this->lang->line('forum_comment_header'); ?></h1>
                <div class="glass-box-container">
                  <p class="uk-margin-small"><?= $this->lang->line('forum_comment_locked'); ?></p>
                  <a href="<?= base_url('login'); ?>" class="uk-button uk-button-default uk-width-1-2 uk-width-1-3@m"><i class="fas fa-sign-in-alt"></i> <?= $this->lang->line('button_login'); ?></a>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <?php if($this->wowauth->isLogged()): ?>
            <div>
              <div class="glass-box">
                <h1 class="glass-box-title uk-text-center"><span uk-icon="icon: comment; ratio: 2"></span> <?= $this->lang->line('forum_comment_header'); ?></h1>
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-width-1-5@s"></div>
                  <div class="uk-width-3-5@s">
                    <?= form_open('', 'id="replyForm" onsubmit="ReplyForm(event)"'); ?>
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
        </article>
      </div>
    </section>
    <?php if($this->wowauth->isLogged()): ?>
    <?= $tiny ?>
    <script>
      function ReplyForm(e) {
        e.preventDefault();

        var news = "<?= $idlink ?>";
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
          url:"<?= base_url($lang.'/news/reply'); ?>",
          method:"POST",
          data:{news, reply},
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
            $('#replyForm')[0].reset();
            window.location.replace("<?= base_url('news/'.$idlink); ?>");
          }
        });
      }
      function DeleteReply(e, value) {
        e.preventDefault();

        $.ajax({
          url:"<?= base_url($lang.'/news/reply/delete'); ?>",
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
            window.location.replace("<?= base_url('news/'.$idlink); ?>");
          }
        });
      }
    </script>
    <?php endif; ?>
