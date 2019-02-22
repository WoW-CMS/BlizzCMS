<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?= base_url('theme/'.$this->config->item('theme_name').'/images/favicon.ico'); ?>">
    <title><?= $this->config->item('ProjectName'); ?> | <?= $pagetitle ?></title>
    <link rel="stylesheet" href="<?= base_url('includes/core/uikit/css/uikit.min.css'); ?>"/>
    <script src="<?= base_url('includes/core/uikit/js/uikit.min.js'); ?>"></script>
    <script src="<?= base_url('includes/core/uikit/js/uikit-icons.min.js'); ?>"></script>
    <script src="<?= base_url('includes/core/fontawesome/js/all.js'); ?>" defer></script>
    <link rel="stylesheet" href="<?= base_url('theme/'.$this->config->item('theme_name').'/css/'.$this->config->item('theme_name').'.css'); ?>"/>
    <script src="<?= base_url('includes/core/js/jquery-3.3.1.min.js'); ?>"></script>
    <link rel="stylesheet" href="<?= base_url('includes/core/amaranjs/css/amaran.min.css'); ?>"/>
    <script src="<?= base_url('includes/core/amaranjs/js/jquery.amaran.min.js'); ?>"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="<?= base_url('includes/core/cookieconsent/css/cookieconsent.min.css'); ?>"/>
    <script type="text/javascript" src="<?= base_url('includes/core/cookieconsent/js/cookieconsent.min.js'); ?>"></script>
    <script>
    window.addEventListener("load", function(){
    window.cookieconsent.initialise({
      "palette": {
        "popup": {
          "background": "#002650"
        },
        "button": {
          "background": "#0e86ca"
        }
      },
      "theme": "edgeless",
      "content": {
        "message": "This website uses cookies to ensure you get the best experience on our website. ",
        "dismiss": "Got it!",
        "link": "Learn more",
        "href": "<?= base_url('cookies'); ?>"
      }
    })});
    </script>
    <link href="<?= base_url('includes/core/pageloader/pace-theme-minimal.tmpl.css'); ?>" rel="stylesheet" />
    <script src="<?= base_url('includes/core/pageloader/pace.min.js'); ?>"></script>
  </head>
  <body>
    <?php $this->load->view('general/menu'); ?>
