<?php
    $files = scandir('.');

    for ($i=0; $i<count($files); $i++) {
        $thefile = $files[$i];
        $fcont = false;
        if ($thefile == '.' || $thefile == '..') {
            continue;
        } else if (strpos($thefile,'.md') !== false) {
            $fcont = file_get_contents($thefile);
            $fcont = substr($fcont,3);
            $fcont = '---'."\nlayout: post".$fcont;

            file_put_contents($thefile,$fcont);
        }
    }
?>
