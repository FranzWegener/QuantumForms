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
     * @param string $message
     * @return $this
     */
    public function setErrorMessage($message);
    /**
     * Returns the error message
     * @return string $message
     */
    public function getErrorMessage();
    
	/**
	 * Returns the name of the Validator (for uniqueness on client side)
	 * @return string
	 */
    public function getName();
}