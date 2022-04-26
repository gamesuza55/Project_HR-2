<?php
//config.php
define('ROOT',str_replace("\\",'/',dirname(__FILE__)));
define('PATH', ROOT == $_SERVER['DOCUMENT_ROOT']
    ?'' :substr(ROOT,strlen($_SERVER['DOCUMENT_ROOT']))
);
// // 
// echo ROOT,'<br />';
// echo PATH,'<br />';
?>
<!-- <a href="<?php echo PATH;?>/index.php">LINK</a> -->