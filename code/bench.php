<?php

define('DATA', str_pad('', 1000, 'abc'));

$callbacks = array(
  'test_cache_set',
  'test_cache_get',
  'test_cache_clear_cid',
  //  'test_cache_clear_wild',
);

/*$runs = 1000;
print $runs . "\n";
foreach ($callbacks as $callback) {
  do_run($callback, $runs);
}

$runs = 10000;
print $runs . "\n";
foreach ($callbacks as $callback) {
  do_run($callback, $runs);
  }*/

$runs = 100000;
print $runs . "\n";
foreach ($callbacks as $callback) {
  do_run($callback, $runs);
}


function do_run($callback, $runs = 100000) {
  $n = 0;
  $start = timer_start($callback);

  while ($n < $runs) {
    $n++;
    $callback($n);
  }
  $stop = timer_stop($callback);

  $time = $stop['time'];

  print $callback . ' ' . $time . " ms\n";
}

function test_cache_set($n) {
  cache_set($n, DATA);
}

function test_cache_get($n) {
  cache_get($n);
}

function test_cache_clear_cid($n) {
  cache_clear_all($n, 'cache');
}

function test_cache_clear_wild() {
  cache_clear_all('*', 'cache', TRUE);
}

