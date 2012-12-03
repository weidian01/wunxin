<?php

define("PROGRESS_DIRECTORY", "G:\\progress");

define('DS', DIRECTORY_SEPARATOR);

define("PROGRESS_MAX_NUM", 10);//个

define("LISTEN_DISTANCE", 1);//秒

define("PROGRESS_TOTAL_NUM", 11);//个

register_shutdown_function('shutdown');

set_time_limit(0);

$sequence = 1;

while (TRUE)
{
    if(get_progress_num() < PROGRESS_MAX_NUM)
    {
        process_execute($sequence++);
    }

    if($sequence > PROGRESS_TOTAL_NUM)
    {
        break;
    }

    sleep(LISTEN_DISTANCE);
}



/**
 * 获取当前进程数量
 * @return int
 */
function get_progress_num()
{
    $files = glob(PROGRESS_DIRECTORY . DS . '*');
    //print_r($files);
    return count($files);
}


function process_execute($sequence = 0)
{
    $pid = date("YmdHis", time()) . '-' . mt_rand(10000, 99999);
    $flag = file_put_contents(PROGRESS_DIRECTORY . DS . $pid, "PROGRESS {$sequence} {$pid} BEGIN" . PHP_EOL);
    if ($flag)
    {
        run($sequence, $pid, PROGRESS_DIRECTORY . DS);
    }
}

function run($sequence, $pid, $dir)
{
    $cmd = "/usr/local/php/bin/php /data/www/wunxin/web/index.php popularize mail run {$dir}{$pid} {$sequence} 1 2 3 > {$dir}{$pid} 2>&1 &" . PHP_EOL;
    //$cmd = "G:\\wamp\\bin\\php\\php5.3.8\\php G:\\wamp\\www\\wunxin\\web\\index.php popularize mail run {$dir}{$pid} {$sequence} 1 2 3 > {$dir}{$pid} 2>&1 &" . PHP_EOL;
    //exec($cmd);
    echo $cmd;
}

function shutdown()
{
    /*/
    $files = glob(PROGRESS_DIRECTORY . DS . '*');
    foreach($files as $pid_file)
    {
        unlink($pid_file);
    }
    //*/
}
?> 
