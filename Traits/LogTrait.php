<?php

namespace nlib\Log\Traits;

use nlib\Path\Classes\Path;

trait LogTrait {

    public function log(array $values, string $file = 'log_') {
        
        if(empty($log = Path::i()->getLog())) die('Log cannot be empty');
        if(empty(is_dir($log))) mkdir($log, 0777);
        $log .= DIRECTORY_SEPARATOR . $file . date('Y-m-d') .'.log';
        
        date_default_timezone_set('Europe/Brussels');
        
        $string = '';
        
        $date = date('Y-m-d H:i:s');
        if(!empty($values)) :
            if(reset($values) === "\n") $string = "\n";
            else foreach($values as $key => $value) $string .= '[' . $date . '] [' . $key . '] ' . $value . PHP_EOL;
        else : $string = '[' . $date . '] [Log] Empty log values.' . PHP_EOL; endif;

        file_put_contents($log, $string, FILE_APPEND);
    }

    public function endlog(string $file = 'log_') { $this->log(["\n"], $file); }
}