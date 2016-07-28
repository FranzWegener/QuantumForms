<?php
namespace QuantumForms\Validators;

use QuantumForms\Validator;
use QuantumForms\ValidatorInterface;

class Integer extends AbstractValidator implements ValidatorInterface
{
    
    /**
     * @return bool
     */
    public function validate($input)
    {
        return is_integer($input);	
    }
    
    /**
     * @return string
     */
    public function getJavascriptValidator()
    {
        return 'function (input) {
                    return !isNaN(parseFloat(input)) && isFinite(input);
                }';	
    }

}