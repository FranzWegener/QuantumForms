<?php
namespace QuantumForms\JsErrorNotifiers;

class Alert implements \QuantumForms\JsErrorNotifierInterface
{
	public function getJsErrorNotifier()
	{
	    return 'function (elementName, validatorName){
    	       alert(\'Input Error: \' + elementName + \' should be \' + validatorName);
    	    }';
	}
} 
