<?php
namespace QuantumForms\Validators;

use QuantumForms\Validator;
use QuantumForms\ValidatorInterface;

class Alphanumeric extends AbstractValidator implements ValidatorInterface
{
    
    /**
     * @return bool
     */
    public function validate($input)
    {
        return ctype_alnum($input);	
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