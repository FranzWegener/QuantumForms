<?php
namespace QuantumForms\Validators;

use QuantumForms\Validator;
use QuantumForms\ValidatorInterface;

class Regex extends AbstractValidator implements ValidatorInterface
{   
    protected $regex;
    /**
     * (non-PHPdoc)
     * @see \QuantumForms\Validators\AbstractValidator::validate()
     * @return bool
     */
    public function validate($input)
    {
        return preg_match($this->regex, $input);	
    }
    
    /**
     * @return string
     */
    public function getJavascriptValidator()
    {
        return 'function (input) {
                    return '.$this->regex.'.test(input);
                }';	
    }
    /**
     * Set regex to be used for validation 
     * @param string $regex
     */
    public function setRegex($regex)
    {
        $this->regex = $regex;
    }
    /**
     * Override getName to be able to use the Validator\Regex multiple times with different regexes configured 
     * (non-PHPdoc)
     * @see \QuantumForms\Validators\AbstractValidator::getName()
     */
    public function getName()
    {
    	return parent::getName().md5($this->regex);
    }
    
}