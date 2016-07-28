<?php

namespace QuantumForms\FormElements; 

use QuantumForms\ValidatorInterface;
abstract class AbstractFormElement implements \QuantumForms\FormElementInterface
{
    const NAME_ATTRIBUTE = 'name';
    const ID_ATTRIBUTE = 'id';
    
    protected $attributes = [];
    protected $htmlBefore = '';
    protected $htmlAfter = '';
    protected $javascriptValidationEnabled = true;
    protected $validators = [];
    
    public function __construct($name)
    {
        if (!is_string($name)) throw new Exception('FormElement::__construct must be passed a string.');
    	$this->attributes[self::NAME_ATTRIBUTE] = $name;
    	$this->attributes[self::ID_ATTRIBUTE] = $name;
    }
    public function getName()
    {
    	return $this->attributes[self::NAME_ATTRIBUTE];
    }
    public function addAttribute($name, $value)
    {
    	$this->attributes[$name] = $value;
    	return $this;
    }
    public function setAttributes(array $attributes)
    {
    	foreach ($attributes as $attributeName => $attributeValue){
    		$this->attributes[$attributeName] = $attributeValue;
    	}
    	return $this;
    }
    
    public function setHtmlBefore($string)
    {
        $this->htmlBefore = $string;
        return $this;
    }
    
    public function setHtmlAfter($string)
    {
        $this->htmlAfter = $string;
        return $this;
    }
    
    public function javascriptValidationEnabled($boolean)
    {
        $this->javascriptValidationEnabled = $boolean;
        return $this;	
    }
    public function addValidator(ValidatorInterface $validator)
    {
    	$this->validators[$validator->getName()] = $validator;
    	return $this;
    }
    public function addValidators(array $validators)
    {
    	foreach ($validators as $validator){
    	    if (!($validator instanceof ValidatorInterface)) {
    	       throw new \Exception('QuantumForms\FormElementInterface::setValidators and QuantumForms\FormElementInterface::addValidators only take array of QuantumForms\ValidatorInterface.');	
    	    }
    		$this->validators[$validator->getName()] = $validator;
    	}
    	return $this;
    }
    public function setValidators(array $validators)
    {
        $this->validators = [];
        return $this->addValidators($validators);
    }
    
    /**
     * This function is normally called by Form::validateInput() during backend form validation
     * it validates against the Validators that are set
     * @return boolean
    */
    public function validateInput($input)
    {
    	foreach ($this->validators as $validator){
    		if (!$validator->validate($input)) return false;
    	}
    	return true;
    }
    public function getValidators()
    {
    	return $this->validators;
    }
    protected function getAttributesString()
    {
        $result = [];
        foreach ($this->attributes as $attributeName => $attributeValue){
        	$result[] = "$attributeName=\"$attributeValue\"";
        }
        return implode(' ', $result);
    }
    abstract function render();
}
