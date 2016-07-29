<?php
namespace QuantumForms\Forms;

use QuantumForms\Config\FunctionNames;
use QuantumForms\Config\Names;
use QuantumForms\JsErrorNotifierInterface;
use QuantumForms\FormElementInterface;

/**
 * The main Form class into which the FormElements get injected 
 * @author Franz Wegener
 *
 */
class Form implements \QuantumForms\FormInterface
{
    protected $method;
    protected $action;
    protected $htmlBefore;
    protected $htmlAfter;
    protected $attributes = [];
    protected $formElements = [];
    protected $jsErrorNotifier;
    protected $jqueryAvailable = false;
    
    /**
     * 
     * @param string $method Form method
     * @param string $action Form action
     * @param JsErrorNotifierInterface $jsErrorNotifier
     */
    public function __construct($method, $action, JsErrorNotifierInterface $jsErrorNotifier)
    {    
    	if (!is_string($method) || !is_String($action)) throw Exception('The parameters $method and $action of QuantumForms\FormInterface::__construct() must be strings.');
    	$this->method = $method;
    	$this->action = $action;
    	$this->jsErrorNotifier = $jsErrorNotifier;
    }
    /**
     * Set if jquery is available.
     * @param boolean $boolean
     */
    public function setJqueryAvailable($boolean)
    {
        $this->jqueryAvailable = $boolean;
    }
    /**
     * (non-PHPdoc)
     * @see \QuantumForms\FormInterface::renderHtml()
     */
    public function renderHtml()
    {
    	$form = $this->htmlBefore;
    	$form.= '<form method="'.$this->method.'" action="'.$this->action.'"';
    	if (!empty($this->attributes)) $form.= ' '.implode(' ', $this->attributes);
    	$form.= '>';
    	
    	foreach ($this->formElements as $element){
    	   $form.= $element->render();	
    	}
    	$form.= '</form>'.$this->htmlAfter;
    	return $form;
    }
    /**
     * (non-PHPdoc)
     * @see \QuantumForms\FormInterface::renderJavascript()
     */
    public function renderJavascript()
    {
        $validatorJsObject = $this->getJsValidators();
        $validatorRegistration = $this->getJsValidatorEventListeners();
        $validationErrorFunction = 'var '.Names::VALIDATOR_ERROR_FUNCTION.' = '.$this->jsErrorNotifier->getJsErrorNotifier().';'; 
        return '<script>'.$validationErrorFunction.$validatorJsObject.$validatorRegistration.'</script>';
    }
    /**
     * (non-PHPdoc)
     * @see \QuantumForms\FormInterface::validateInput()
     */
    public function validateInput(array $request)
    {
        $errors = [];
        foreach ($this->formElements as $element)
        {
        	$result = $element->validateInput($request[$element->getName()]);
        	if (!$result) $errors[] = $element->getName();
        }
        if (!empty($errors)) return $errors;
        return true;
    }
    /**
     * (non-PHPdoc)
     * @see \QuantumForms\FormInterface::addElement()
     */
    public function addElement(FormElementInterface $element, $id = '')
    {
        if (empty($id)) {
            $id = count($this->formElements);
            while (isset($this->formElements[$id])) $id++; 
        }
    	$this->formElements[$id] = $element;
    }
    /**
     * (non-PHPdoc)
     * @see \QuantumForms\FormInterface::addAttribute()
     */
    public function addAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }
    /**
     * (non-PHPdoc)
     * @see \QuantumForms\FormInterface::setAttributes()
     */
    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $attributeName => $attributeValue){
            $this->attributes[$attributeName] = $attributeValue;
        }
        return $this;
    }
    /**
     * (non-PHPdoc)
     * @see \QuantumForms\FormInterface::setHtmlBefore()
     */
    public function setHtmlBefore($string)
    {
        $this->htmlBefore = $string;
        return $this;
    }
    /**
     * (non-PHPdoc)
     * @see \QuantumForms\FormInterface::setHtmlAfter()
     */
    public function setHtmlAfter($string)
    {
        $this->htmlAfter = $string;
        return $this;
    }
    /**
     * Returns the code for all js-validators used as a js-object
     * @return string
     */
    protected function getJsValidators()
    {
        $validators = [];
        foreach ($this->formElements as $formElement){
        	$validators = array_merge($formElement->getValidators(), $validators);
        }
        $result = 'var '.Names::VALIDATOR_OBJECT.' = {'.PHP_EOL;
        $validatorFunctions = [];
        foreach ($validators as $validator){
            $validatorFunctions[] = $validator->getName().': '.$validator->getJavascriptValidator();
        }
        $result.=implode(', ', $validatorFunctions).'};';
        return $result.PHP_EOL;
    }
    /**
     * Returns the code to register js event listeners
     * @return string
     */
    protected function getJsValidatorEventListeners()
    {
        if ($this->jqueryAvailable) {
            $result = '$(document).ready(function() {';
        } else {
            $result = 'document.addEventListener("DOMContentLoaded", function() {';
        }
        foreach ($this->formElements as $formElement){
            $result.= PHP_EOL.'document.getElementById("'.$formElement->getName().'").addEventListener("blur", function ()
			{
				errors = [];';
            $validators = $formElement->getValidators();
            foreach ($validators as $validatorName => $validator){
            	$result.= PHP_EOL.'if (!'.Names::VALIDATOR_OBJECT.'.'.$validatorName.'(document.getElementById("'.$formElement->getName().'").value)) errors.push("'.$validator->getErrorMessage().'");';
            }
            $result.= 'if (errors.length>0) '.Names::VALIDATOR_ERROR_FUNCTION.'("'.$formElement->getName().'", "'.$validatorName.'", errors);});';
        }
        return $result.'});'.PHP_EOL;
    }
}