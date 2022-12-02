<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 Page Not Found</title>
    <style type="text/css">
      html {
        background: #f5f6f8;
        color: #6f7079;
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        font-size: 16px;
        font-weight: 400;
        line-height: 1;
      }

      body {
        margin: 0;
      }

      a {
        color: #105fff;
        transition: all ease .15s;
      }

      a:hover {
        color: #004de8;
      }

      h1 {
        color: #494a50;
        font-size: 1.125rem;
        font-weight: 700;
        margin: 10px 0;
        text-transform: uppercase;
      }

      p {
        margin: 10px 0;
      }

      code {
        display: block;
        font: 0.875rem/1.5 Consolas,monaco,monospace;
        background-color: #f5f6f8;
        border: 1px solid #e9ecf0;
        color: #5c5d65;
        margin: 10px 0;
        padding: 10px;
      }

      section {
        position: relative;
        margin-top: 30px;
        padding-left: 30px;
        padding-right: 30px;
      }

      .card {
        position: relative;
        background: #fff;
        border-radius: 4px;
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgba(0, 0, 0, .025);
      }

      .card-head {
        border-bottom: 1px solid rgba(0, 0, 0, .05);
        padding: 15px;
      }

      .card-head h1 {
        margin: 0;
      }

      .card-body {
        padding: 15px;
      }
    </style>
  </head>
  <body>
    <section>
      <div class="card">
        <div class="card-head">
          <h1><?php echo $heading; ?></h1>
        </div>
        <div class="card-body">
          <?php echo $message; ?>
        </div>
      </div>
    </section>
  </body>
</html>
