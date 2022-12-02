<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section style="position:relative;margin-top:15px;padding-left:30px;padding-right:30px">
  <div style="position:relative;background-color:#fff;box-sizing:border-box;box-shadow:0 15px 25px rgba(0,0,0,.025);border-top:3px solid #f71212;border-radius:4px;padding:15px">
    <h4 style="margin-top:0">An uncaught Exception was encountered</h4>
    <p>Type: <?php echo get_class($exception); ?></p>
    <p>Message: <?php echo $message; ?></p>
    <p>Filename: <?php echo $exception->getFile(); ?></p>
    <p>Line Number: <?php echo $exception->getLine(); ?></p>

    <?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>
    <p>Backtrace:</p>
    <?php foreach ($exception->getTrace() as $error): ?>
    <?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>
    <p style="margin-left:15px">
      File: <?php echo $error['file'] ?><br />
      Line: <?php echo $error['line'] ?><br />
      Function: <?php echo $error['function'] ?>
    </p>
    <?php endif ?>
    <?php endforeach ?>
    <?php endif ?>
  </div>
</section>
