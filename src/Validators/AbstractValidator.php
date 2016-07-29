<?php
namespace QuantumForms\Validators;

use QuantumForms\Validator;
use QuantumForms\ValidatorInterface;
/**
 * Contains standard methods that most validators need in this way
 * @author Franz Wegener
 *
 */
abstract class AbstractValidator implements ValidatorInterface
{
	protected $errorMessage = 'Error in Input';

	/**
	 * Standard is "Error in Input"
	 * @param unknown $message
	 */
	public function setErrorMessage($message)
	{
	   $this->errorMessage = $message;	
	}
	
	/**
	 * Returns the error message
	 * @return string
	 */
	public function getErrorMessage()
	{
		return $this->errorMessage;
	}
	/**
	 * Returns the name of the Validator (for uniqueness on client side)
	 * @return string
	 */
	public function getName()
	{
	   $class = get_class($this);
	   if (strrpos($class, '\\') !== false) $class = substr($class, strrpos($class, '\\') + 1);
	   return $class;	
	}
	/**
	 * (non-PHPdoc)
	 * @see \QuantumForms\ValidatorInterface::validate()
	 */
	abstract public function validate($input);
	/**
	 * (non-PHPdoc)
	 * @see \QuantumForms\ValidatorInterface::getJavascriptValidator()
	 */
	abstract public function getJavascriptValidator();
	 
}