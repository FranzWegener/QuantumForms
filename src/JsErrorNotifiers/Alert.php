<?php
namespace QuantumForms\JsErrorNotifiers;

/**
 * Returns a client side form input error handler that opens an alert box  
 * @author Franz Wegener
 *
 */
class Alert implements \QuantumForms\JsErrorNotifierInterface
{
	public function getJsErrorNotifier()
	{
	    return 'function (elementName, errors){
	                var message = "There were validation errors: \n";
            	    for (var validatorName in errors) {
                        if (errors.hasOwnProperty(validatorName)) {
                            message = message.concat("Element " + elementName + ", Validator " + validatorName + ": " + errors[validatorName] + " \n");
                        }
                    }
    	            alert(message);
    	        }';
	}
} 
