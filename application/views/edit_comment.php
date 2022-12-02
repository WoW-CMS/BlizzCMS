<section class="uk-section uk-section-small bc-primary-section" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
          <li><a href="<?= site_url('news/'.$article->id.'/'.$article->slug) ?>"><?= html_escape($article->title) ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('edit_comment') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <?= form_open(current_url()) ?>
      <div class="uk-margin">
        <div class="uk-form-controls">
            <textarea class="uk-textarea tmce-comment" name="comment" rows="7" autocomplete="off"><?= $comment->comment_content ?></textarea>
        </div>
        <?= form_error('comment', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
      </div>
      <button class="uk-button uk-button-default" type="submit"><?= lang('save') ?></button>
    <?= form_close() ?>
  </div>
</section>
