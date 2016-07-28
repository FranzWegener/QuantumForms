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
	    return 'function (elementName, validatorName){
    	       alert(\'Input Error: \' + elementName + \' should be \' + validatorName);
    	    }';
	}
} 
