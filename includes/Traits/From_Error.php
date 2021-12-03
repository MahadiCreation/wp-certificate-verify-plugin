<?php

namespace Mahadicreation\CertificateVerify\Traits;
/**
 * Error handler trait
 */
trait From_Error
{
    /**
     * Holds the error
     * @var array
     */
    public $errors = [];


    /**
     * Check if from has error
     * @param $key
     * @return bool
     */
    public function has_error( $key ){
        return isset($this->errors[ $key ]) ? true : false;
    }

    /**
     * Get the error message
     * @param $key
     * @return false|mixed
     */
    public function get_error( $key ){
        if (isset($this->errors[$key])){
            return $this->errors[$key];
        }else{
            return false;
        }
    }
}