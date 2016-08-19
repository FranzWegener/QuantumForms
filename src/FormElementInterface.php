<?php
namespace QuantumForms;
/**
 * Interface for FormElements
 * @author Franz Wegener
 *
 */
interface FormElementInterface
{
    /**
     * Name of the FormElement as it will be returned by the submit
     * @param string $name
     */
    public function __construct($name);
    
    /**
     * @return string Name of the FormElement
     */
    public function getName();
    
    /**
     * Add attribute to be added to the FormElement
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function addAttribute($name, $value);
    /**
     * Set attributes to be added to the FormElement
     * @param array($attributeName => $attributeValue, ...)
     * @return $this
     */
    public function setAttributes(array $attributes);
    /**
     * Set HTML to be output before the FormElement
     * @param string $string
     * @return $this
     */
    public function setHtmlBefore($string);
    /**
     * Set HTML to be output after the FormElement
     * @param string $string
     * @return $this
     */
    public function setHtmlAfter($string);
    
    /**
     * Add one Validator
     * @param ValidatorInterface $validator
     * @return $this
     */
    public function addValidator(ValidatorInterface $validator);
    
    /**
     * Add multiple Validators as array of ValidatorInterface
     * @param array $validators
     * @return $this
     */
    public function addValidators(array $validators);
    
    /**
     * Set all validators as array of ValidatorInterface
     * @param array $validators
     * @return $this
     */
    public function setValidators(array $validators);
    /**
     * Returns an array with all validators
     * @return array of ValidatorInterface
     */
    public function getValidators();
    
    /**
     * This function is normally called by Form::validateInput() during backend form validation
     * it validates against the Validators that are set
     * @return boolean
    */
    public function validateInput($input);
    
    /**
     * Renders the HTML of the FormElement
     * @return string
     */
    public function render();
    
    /**
     * Set the tag attribute used to identify the element by the JS Validator
     * @param string $string
     * @return $this
     */
    public function setIdentifyingAttribute($string);
    /**
     * Get the tag attribute used to identify the element by the JS Validator 
     * @return $string
     */
    public function getIdentifyingAttribute();

    /**
     * Set the value of the element for automatic population
     * @param $value
     * @return $this
     */
    public function setValue($value);
}