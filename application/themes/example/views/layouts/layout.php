<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $template['title'] ?></title>
    <link rel="icon" type="image/x-icon" href="<?= $template['location'].'assets/images/favicon.ico' ?>">
    <link rel="stylesheet" href="<?= $template['assets'].'uikit/css/uikit.min.css' ?>">
    <link rel="stylesheet" href="<?= $template['location'].'assets/css/theme.css' ?>">
    <script src="<?= $template['assets'].'uikit/js/uikit.min.js' ?>"></script>
    <script src="<?= $template['assets'].'uikit/js/uikit-icons.min.js' ?>"></script>
    <script src="<?= $template['assets'].'js/jquery.min.js' ?>"></script>
    <script src="<?= $template['assets'].'fontawesome/js/all.js' ?>" defer></script>
    <?= $template['head_data'] ?>
  </head>
  <body>

    <?= $template['body'] ?>

    <?= $template['body_data'] ?>
  </body>
</html>