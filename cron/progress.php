<?php

define("PROGRESS_DIRECTORY", "G:\\progress");

define('DS', DIRECTORY_SEPARATOR);

define("PROGRESS_MAX_NUM", 10);//个

define("LISTEN_DISTANCE", 1);//秒

define("PROGRESS_TOTAL_NUM", 11);//个

set_time_limit(0);

$sequence = 1;

$progress_id = date("YmdHis", time());

register_shutdown_function('shutdown', $progress_id);

set_primary($progress_id);

while (TRUE)
{

    if(get_progress_num($progress_id) <= PROGRESS_MAX_NUM)
    {
        up_primary($progress_id, $sequence);
        process_execute($progress_id, $sequence++);
    }

    if($sequence > PROGRESS_TOTAL_NUM)
    {
        break;
    }

    sleep(LISTEN_DISTANCE);
}

function set_primary($progress_id)
{
    mkdir(PROGRESS_DIRECTORY . DS . $progress_id, 0777);
    file_put_contents(PROGRESS_DIRECTORY . DS . $progress_id . DS . $progress_id, '');
}

function up_primary($progress_id, $sequence)
{
    file_put_contents(PROGRESS_DIRECTORY . DS . $progress_id . DS . $progress_id, $sequence . PHP_EOL, FILE_APPEND);
}

/**
 * 获取当前进程数量
 * @return int
 */
function get_progress_num($progress_id)
{
    $files = glob(PROGRESS_DIRECTORY . DS . $progress_id . DS . '*');
    //print_r($files);
    return count($files);
}


function process_execute($progress_id, $sequence = 0)
{
    $pid = date("YmdHis", time()) . '-' . mt_rand(10000, 99999);
    $flag = file_put_contents(PROGRESS_DIRECTORY . DS . $progress_id . DS . $pid , "PROGRESS {$sequence} {$pid} BEGIN" . PHP_EOL);
    if ($flag)
    {
        run($sequence, $pid, PROGRESS_DIRECTORY . DS . $progress_id .DS);
    }
}

function run($sequence, $pid, $dir)
{
    $cmd = "/usr/local/php/bin/php /data/www/wunxin/web/index.php popularize mail run {$dir}{$pid} {$sequence} 1 2 3 > {$dir}{$pid} 2>&1 &" . PHP_EOL;
    //$cmd = "G:\\wamp\\bin\\php\\php5.3.8\\php G:\\wamp\\www\\wunxin\\web\\index.php popularize mail run {$dir}{$pid} {$sequence} 1 2 3 > {$dir}{$pid} 2>&1 &" . PHP_EOL;
    //exec($cmd);
    echo $cmd;
}

function shutdown($progress_id)
{
    /*/
    $files = glob(PROGRESS_DIRECTORY . DS . $progress_id . DS . '*');
    foreach($files as $pid_file)
    {
        unlink($pid_file);
    }
    //*/
}
?> 
