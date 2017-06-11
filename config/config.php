<?php
/**
 * Configuration files are loaded in a specific order: global, local
 *   global.php
 *   *.global.php
 *   local.php
 *   *.local.php
 *
 * Use *global.php for generic settings, *local.php for credentials and overriding global settings.
 */

$config = [];

$globPath = 'config/autoload/{{,*.}global,{,*.}local}.php';
foreach (glob($globPath, GLOB_BRACE) as $file) {
    $config = array_merge($config, include $file);
}

return $config;
