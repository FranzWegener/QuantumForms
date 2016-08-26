<?php

namespace QuantumForms\Validators;
use QuantumForms\ValidatorInterface;

/**
 * Class IsNotEmpty
 * @author Franz Wegener
 * @package QuantumForms\Validators
 */
class IsNotEmpty extends AbstractValidator implements ValidatorInterface {

    /**
     * Validate the input
     *
     * @param $input
     * @return bool
     */
    public function validate($input) {

        return !empty($input);
    }

    /**
     * Return JS validator
     *
     * @return string
     */
    public function getJavascriptValidator() {

        return 'function (input) {
                    return (input != "");
                }';
    }
}