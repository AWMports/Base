<?php
/*
 * This uses the autoload class from
 *  https://github.com/AliceWonderMiscreations/php-ccm/blob/master/ClassLoader.php
 * with the ezcBase class installed in
 *  /usr/share/ccm/custom/libraries/awmports/ezcbase/
 *
 */

$branchpath = 'custom:stable';

require('/usr/share/ccm/ClassLoader.php');
$CCM = new \AliceWonderMiscreations\CCM\ClassLoader($branchpath);
$CCM->changeDefaultSearchPath($branchpath);


spl_autoload_register(function ($class) {
  global $CCM;
  $CCM->loadClass($class);
});

spl_autoload_register(function ($class) {
  global $CCM;
  $CCM->localSystemClass($class);
});
?>
