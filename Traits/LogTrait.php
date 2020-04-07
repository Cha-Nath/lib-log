<?php

namespace nlib\Log\Traits;

use nlib\Path\Classes\Path;

trait LogTrait {

    public function log(array $values, string $file = 'log_') : string {
        
        if(empty($log = Path::i()->getLog())) die('Log cannot be empty');
        // if(empty(is_dir($log))) mkdir($log, 0777);

        $this->clog();
        $log .= DIRECTORY_SEPARATOR . $file . date('Y-m-d') .'.log';
        
        date_default_timezone_set('Europe/Brussels');
        
        $string = '';
        
        $date = date('Y-m-d H:i:s');
        if(!empty($values)) :
            if(reset($values) === "\n") $string = "\n";
            else foreach($values as $key => $value) $string .= '[' . $date . '] [' . $key . '] ' . (is_array($value) ? json_encode($value) : $value) . PHP_EOL;
        else : $string = '[' . $date . '] [Log] Empty log values.' . PHP_EOL; endif;

        file_put_contents($log, $string, FILE_APPEND);

        return $string;
    }

    public function endlog(string $file = 'log_') : void { $this->log(["\n"], $file); }

    public function dlog(array $values, string $file = 'log_') : void {
        $message = $this->log($values, $file);
        $this->endlog($file);
        die($message);
    }

    public function jlog(array $values, string $file = 'log_') : void {
        header('Content-type: application/json');
        echo json_encode($values);
        $this->log($values, $file);
        $this->endlog($file);
        die;
    }

    public function clog() : void {

        $excludes = ['.', '..', 'index.php'];

        if(empty($log = Path::i()->getLog())) die('Log cannot be empty');

        if($folder = opendir($log)) :

            while(false !== ($file = readdir($folder))) :
                
                if(!in_array($file, $excludes)) :

                    $time = explode('_', explode('.', $file)[0]);
                    if(strtotime(end($time)) < time() - 7 * 24 * 3600) unlink($log . $file);

                endif;
            endwhile;

            closedir($folder);

        endif;
    }
}