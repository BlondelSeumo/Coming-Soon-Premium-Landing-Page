<?php

$root = __DIR__;

$storage = $root . DIRECTORY_SEPARATOR . 'storage';

$paths = [
    $root . DIRECTORY_SEPARATOR . '.env',
    $storage,
    $storage . DIRECTORY_SEPARATOR . 'app',
    $storage . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'public',
    $storage . DIRECTORY_SEPARATOR . 'framework',
    $storage . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'cache',
    $storage . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'sessions',
    $storage . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'testing',
    $storage . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'views',
    $storage . DIRECTORY_SEPARATOR . 'logs',
];

$valid = true;
$errorPaths = [];

foreach ($paths as $path) {

    if(!is_writeable($path)){
        $valid = false;
        $errorPaths[] = $path;
    }

    
}

if ($valid && isset($_POST['field1']) && isset($_POST['field2']) && isset($_POST['field3']) && isset($_POST['field4'])) {

$txt = <<<EOD
APP_NAME="Coming Soon"
APP_ENV=local
APP_KEY=base64:sPfi4x39mJiiE0260p+DnBCgf4xe8nv9QyFKDjaGtrU=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST={$_POST['field1']}
DB_PORT=3306
DB_DATABASE={$_POST['field2']}
DB_USERNAME={$_POST['field3']}
DB_PASSWORD={$_POST['field4']}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=

EOD;

file_put_contents('.env', $txt . "\n");  

header('Location: public/installer');

exit;
               
}

?>
<!DOCTYPE html>
<html>
    <head>

        <title>Coming-Soon Installer</title>

        <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">

        <style>
            body{
                padding: 50px;
            }
        </style>
    </head>
    <body>
    <?php
        if ($errorPaths) {
            echo '<div class="alert alert-danger">';
            foreach($errorPaths as $path) {
                echo "<p>{$path} is not writable</p>";
            }
            echo '</div>';
        }
    ?>
        <h1> Installer.Form</h1>

        <form  method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="inputdbhost" class="col-sm-1 control-label">DB-Host</label>
                    <div class="col-sm-10">
                        <input  class="form-control" id="inputdbhost" name="field1" type="text" />
                    </div>
                </div>

                <div class="form-group" >
                    <label for="inputdbname" class="col-sm-1 control-label">DB-Name</label>
                    <div class="col-sm-10">
                        <input id="inputdbname"  class="form-control" name="field2" type="text" />
                    </div>
                </div>

                <div class="form-group" >
                    <label for="inputdbuser" class="col-sm-1 control-label">DB-User</label>
                    <div class="col-sm-10">
                        <input id="inputdbuser"  class="form-control" name="field3" type="text" /> 
                    </div>
                </div>
                    
                <div class="form-group" >
                    <label for="inputdbpass" class="col-sm-1 control-label">DB-Pass</label>
                    <div class="col-sm-10">
                        <input id="inputdbpass"  class="form-control" name="field4" type="text" /> 
                </div>


                <button style="width: 80%; margin: 50px auto 0 auto; font-size: 20px" type="submit" class="btn btn-block btn-primary">Install</button>

        </form>

    </body>
</html>



