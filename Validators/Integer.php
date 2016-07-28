<?php
namespace QuantumForms\Validators;

use QuantumForms\Validator;
use QuantumForms\ValidatorInterface;
/**
 * Validator that checks if the input is integer
 * @author Franz Wegener
 *
 */
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