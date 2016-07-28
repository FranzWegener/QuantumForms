<?php
namespace QuantumForms;
/**
 * Interface for Validators
 * @author Franz Wegener
 *
 */
interface ValidatorInterface
{
    /**
     * @return bool
     */
    public function validate($input);
    
    /**
     * @return string
     */
    public function getJavascriptValidator();
    
    /**
     * Sets the error message in case of an error.
     * Standard is "Error in Input"
     * @param unknown $message
     */
    public function setErrorMessage($message);
    /**
     * Sets the css class that the client validation should add in case of an error
     * Standard is "error"
     * @param string $cssClassName
     */
    public function setErrorCssClass($cssClassName);
    
	/**
	 * Returns the name of the Validator (for uniqueness on client side)
	 * @return string
	 */
    public function getName();
}