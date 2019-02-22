<?php

function targetFiles($target)
{
    if (is_dir($target)):
        $files = glob($target . '*', GLOB_MARK);

        foreach($files as $file):
            targetFiles($file);
        endforeach;
        rmdir($target);
    elseif (is_file($target)):
        unlink($target);
    endif;
}
