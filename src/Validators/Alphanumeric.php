<?php
namespace QuantumForms\Validators;

use QuantumForms\Validator;
use QuantumForms\ValidatorInterface;
/**
 * Validator that checks if the input is alphanumeric
 * @author Franz Wegener
 *
 */
class Alphanumeric extends AbstractValidator implements ValidatorInterface
{
    
    /**
     * @return bool
     */
    public function validate($input)
    {
        if (is_integer($input)) $input = (string)$input;
        if (!is_string($input)) return false;
        return ctype_alnum((string)$input);	
    }
    
    /**
     * @return string
     */
    public function getJavascriptValidator()
    {
        return 'function (input) {
                    return /^[a-z0-9]+$/i.test(input);
                }';	
    }

}