<?php

// prefix used for memcache keys
define('CACHE_PREFIX',                          env('CACHE_PREFIX', substr(md5(php_uname("n").'|bandolier|'), 0, 5)));
// whether to use local cache or remote memcache
define('CACHE_USE_LOCAL',                       env('CACHE_USE_LOCAL', false));
// class name used for local callback
define('CACHE_LOCAL_FALLBACK_CLASS',            env('CACHE_LOCAL_FALLBACK_CLASS', 'Local'));
// local callback file file location
define('CACHE_LOCAL_FALLBACK_CLASS_LOCATION',   env('CACHE_LOCAL_FALLBACK_CLASS_LOCATION', dirname(__FILE__)));
// memcache host
define('CACHE_HOST',                            env('CACHE_HOST', 'localhost'));
// memcache port
define('CACHE_PORT',                            env('CACHE_PORT', '11111'));
