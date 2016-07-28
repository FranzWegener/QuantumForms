<?php
namespace QuantumForms;

interface FormElementInterface
{
    public function __construct($name);
    public function getName();
    public function addAttribute($name, $value);
    public function setAttributes(array $attributes);
    public function setHtmlBefore($string);
    public function setHtmlAfter($string);
    public function javascriptValidationEnabled($boolean);
    public function addValidator(ValidatorInterface $validator);
    public function addValidators(array $validators);
    public function setValidators(array $validators);
    /**
     * Returns an array with all validators
     * @return array
     */
    public function getValidators();
    
    /**
     * This function is normally called by Form::validateInput() during backend form validation
     * it validates against the Validators that are set
     * @return boolean
    */
    public function validateInput($input);
    public function render();
}