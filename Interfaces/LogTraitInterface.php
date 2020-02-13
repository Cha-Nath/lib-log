<?php

namespace nlib\Log\Interfaces;

interface LogTraitInterface {

    /**
     *
     * @param array $values
     * @param string $file
     * @return void
     */
    public function log(array $values, string $file = 'log_') : void;

    /**
     *
     * @param string $file
     * @return void
     */
    public function endlog(string $file = 'log_') : void;
}