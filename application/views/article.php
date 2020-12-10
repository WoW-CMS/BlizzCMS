    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-3-4@m">
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-header">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-width-expand@s">
                    <h5 class="uk-h5 uk-text-bold"><i class="fas fa-newspaper"></i> <?= $news->title; ?></h5>
                  </div>
                  <div class="uk-width-auto@s">
                    <p class="uk-text-small"><i class="far fa-clock"></i> <?= date('F j, Y, h:i a', $news->created_at); ?></p>
                  </div>
                </div>
              </div>
              <div class="uk-card-body">
                <article class="uk-article">
                  <?= $news->description; ?>
                </article>
              </div>
            </div>
            <?php if (isset($comments) && ! empty($comments)): ?>
            <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-margin" data-uk-grid>
              <?php foreach ($comments as $comment): ?>
              <div>
                <div class="uk-card uk-card-default uk-card-body">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-6@s">
                      <div class="Author <?php if($this->auth->get_gmlevel($comment->author) > 0) echo 'topic-author-staff'; ?> uk-flex uk-flex-center">
                        <div class="topic-author-avatar profile">
                          <img src="<?= $template['uploads'].'avatars/'.$this->website->user_avatar($comment->author); ?>" alt="Avatar">
                        </div>
                      </div>
                      <p class="uk-margin-remove uk-text-bold uk-text-center"><?= $this->website->get_user($comment->author, 'nickname'); ?></p>
                      <?php if ($this->auth->get_gmlevel($comment->author) > 0): ?>
                      <div class="author-rank-staff"><i class="fas fa-fire"></i> Staff</div>
                      <?php endif; ?>
                    </div>
                    <div class="uk-width-expand@s">
                      <p class="uk-text-small uk-text-meta uk-margin-small"><?= date('F d Y - H:i A', $comment->created_at); ?></p>
                      <?= $comment->commentary ?>
                      <?php if ($this->auth->get_gmlevel($this->session->userdata('id')) > 0 || $this->session->userdata('id') == $comment->author && now() < strtotime('+30 minutes', $comment->created_at)): ?>
                      <div class="uk-margin-small-top">
                        <button class="uk-button uk-button-danger uk-button-small" value="<?= $comment->id ?>" id="button_delete<?= $comment->id ?>" onclick="DeleteReply(event, this.value)"><i class="fas fa-trash-alt"></i> <?= lang('delete'); ?></button>
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
            <?= $links; ?>
            <?php endif; ?>
            <?php if ($this->website->isLogged()): ?>
            <div class="uk-card uk-card-default uk-card-body uk-margin-small">
              <h3 class="uk-h3 uk-text-center"><span uk-icon="icon: comment; ratio: 1.5"></span> <?= lang('forum_comment_header'); ?></h3>
              <?= form_open('', 'id="replyForm" onsubmit="ReplyForm(event)"'); ?>
              <div class="uk-margin-small uk-light">
                <textarea class="uk-textarea tinyeditor" id="reply_comment" rows="10"></textarea>
              </div>
              <div class="uk-margin-small">
                <button class="uk-button uk-button-default uk-width-1-1" type="submit" id="button_reply"><i class="fas fa-reply"></i> <?= lang('add_reply'); ?></button>
              </div>
              <?= form_close(); ?>
            </div>
            <?php endif; ?>
          </div>
          <div class="uk-width-1-4@m">
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="fas fa-list-alt"></i> <?= lang('home_latest_news'); ?></h5>
              </div>
              <div class="uk-card-body">
                <ul class="uk-list uk-list-divider uk-text-small">
                  <?php foreach ($aside as $item): ?>
                  <li>
                    <a href="<?= site_url('news/'.$item->id); ?>"><i class="far fa-newspaper"></i> <?= $item->title; ?></a>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php if ($this->website->isLogged()): ?>
    <?= $tiny ?>
    <script>
      function ReplyForm(e) {
        e.preventDefault();

        var news = "<?= $news->id; ?>";
        var reply = tinymce.get('reply_comment').getContent();
        var content = tinymce.get('reply_comment').getContent({format: 'text'}).replace('&nbsp;','').trim();
        if(content == "" || content == null || content == '<p> </p>'){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= lang('notification_title_error'); ?>',
              message: '<?= lang('notification_reply_empty'); ?>',
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
          url:"<?= base_url('news/reply'); ?>",
          method:"POST",
          data:{news, reply},
          dataType:"text",
          beforeSend: function(){
            $.amaran({
              'theme': 'awesome info',
              'content': {
                title: '<?= lang('notification_title_info'); ?>',
                message: '<?= lang('notification_checking'); ?>',
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
                  title: '<?= lang('notification_title_success'); ?>',
                  message: '<?= lang('notification_reply_created'); ?>',
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
            window.location.replace("<?= base_url('news/'.$news->id); ?>");
          }
        });
      }
      function DeleteReply(e, value) {
        e.preventDefault();

        $.ajax({
          url:"<?= base_url('news/reply/delete'); ?>",
          method:"POST",
          data:{value},
          dataType:"text",
          beforeSend: function(){
            $.amaran({
              'theme': 'awesome info',
              'content': {
                title: '<?= lang('notification_title_info'); ?>',
                message: '<?= lang('notification_checking'); ?>',
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
                  title: '<?= lang('notification_title_success'); ?>',
                  message: '<?= lang('notification_reply_deleted'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            window.location.replace("<?= base_url('news/'.$news->id); ?>");
          }
        });
      }
    </script>
    <?php endif; ?>
