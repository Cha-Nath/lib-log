<?php

namespace nlib\Log\Interfaces;

interface LogTraitInterface {

    /**
     *
     * @param array $values
     * @param string $file
     * @return string
     */
    public function log(array $values, string $file = 'log_') : string;

    /**
     *
     * @param string $file
     * @return void
     */
    public function endlog(string $file = 'log_') : void;

    /**
     * Log & die
     *
     * @param array $values
     * @param string $file
     * @return void
     */
    public function dlog(array $values, string $file = 'log_') : void;

    /**
     * echo JSON, log & die
     *
     * @param array $values
     * @param string $file
     * @return void
     */
    public function jlog(array $values, string $file = 'log_') : void;
}