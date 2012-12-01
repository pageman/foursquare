<?php
/**
 *
 * @author tanaka-m
 * @date 12/11/26 18:28
 */
try
{
    $payload = json_decode($_REQUEST['payload']);
}
catch(Exception $e)
{
    exit(0);
}

if(!file_exists('../fuel/app/logs/deploy/development/'))
{
    mkdir('../fuel/app/logs/deploy/development/', 0777, true);
}


//log the request
file_put_contents('../fuel/app/logs/deploy/development/github.txt', print_r($payload, TRUE), FILE_APPEND);


if (true || $payload->ref === 'refs/heads/master')
{
    // path to your site deployment script
    exec('../scripts/build.sh');
}
