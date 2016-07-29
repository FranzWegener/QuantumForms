# QuantumForms
QuantumForms is an easily customizable FormBuilder that uses the same validators in frontend and backend.

Features
========
 - standalone: no dependencies, so it is framework independent and no dependency management is needed
 - easy to use and easy to extend
   - add a validator by adding a class to the Validators directory (all validators include the frontend and backend part)
   - add a Javascript Form Error handler by adding a js-closure to JsErrorNotifiers
   - add new type of FormElements by adding a class to the FormElementsDirectory
   - exchange the Form-builder itself by adding to the Forms directory 
 - low bandwith (only the validators you use are transmitted to client-side)
 - PSR4

[![Github made-in](https://img.shields.io/badge/Made_In-Berlin-green.svg)](#) [![Build Status](https://travis-ci.org/FranzWegener/QuantumForms.svg?branch=master)](https://travis-ci.org/FranzWegener/QuantumForms) [![Coverage Status](https://coveralls.io/repos/github/FranzWegener/QuantumForms/badge.svg?branch=master)](https://coveralls.io/github/FranzWegener/QuantumForms?branch=master)

## How to use

Form definition
===============

// instantiate the loader
$quantumFormsRootPath = 'path-to-quantum-forms/src';

require_once $quantumFormsRootPath.'/Autoloader.php';
$loader = new Autoloader();

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('QuantumForms', $quantumFormsRootPath);
unset($quantumFormsRootPath);

//create Form
$form = new Form('GET', '/desired/form/action.php', new Alert());

$ageElement = new TextInput('age');
$ageElement->setValidators([new Integer()]);
$form->addElement($ageElement);

$nameElement = new TextInput('name');
$nameElement->setValidators([new Alphanumeric()]);
$nameElement->setAttributes(['class' => 'form-control', 'id' =>'the-name-field']);
$nameElement->setHtmlBefore('<div class="border">');
$nameElement->setHtmlAfter('<p>Some text</p></div>');
$form->addElement($nameElement);

$submitElement = new Submit('submit');
$form->addElement($submitElement);

Form Rendering
==============
Inject the form-object into your view

<html>
	<head>
		<?= $form->renderJavascript(); ?>
	</head>
	<body>
		<?= $form->renderHtml(); ?>
	</body>
</html>

## How to extend
Add FormElement
===============
Add file with new FormElement name to the /src/FormElements directory, e.g. src/FormElements/Example
<?php
namespace QuantumForms\FormElements;

/**
 * Example FormElement
 */
class Example extends AbstractFormElement implements \Quantumforms\FormElementInterface
{
    /**
     * (non-PHPdoc)
     * @see \QuantumForms\FormElements\AbstractFormElement::render()
     */
    public function render()
    {
        $attributes = $this->getAttributesString();
    	return $this->htmlBefore.'<example '.$attributes.'/>'.$this->htmlAfter;
    }    
}
Add a test for your FormElement to /tests/FormElements/Example.php

Add Javascript Method to be invoked on a form error
===================================================
Add file with JsErrorNotifier name to the /src/JsErrorNotifiers directory, e.g. src/JsErrorNotifiers/Example
<?php
namespace QuantumForms\JsErrorNotifiers;

/**
 * Example JsErrorNotifier
 */
class Example implements \QuantumForms\JsErrorNotifierInterface
{
	public function getJsErrorNotifier()
	{
	    return 'function (elementName, validatorName){
    	       //do something
    	    }';
	}
} 

Add a test for your JsErrorNotifier to /tests/JsErrorNotifiers/Example.php

Add Validator
=============
Add file with validator name to the /src/Validators directory, e.g. src/Validators/Example

<?php
namespace QuantumForms\Validators;

use QuantumForms\Validator;
use QuantumForms\ValidatorInterface;
/**
 * Example Validator 
 */
class Example extends AbstractValidator implements ValidatorInterface
{
    
    /**
     * @return bool
     */
    public function validate($input)
    {
        $bool = some_validation($input); 
        return $bool;
    }
    
    /**
     * @return string
     */
    public function getJavascriptValidator()
    {
        return 'function (input) {
                    bool = some_validation(input);
                    return bool;
                }';	
    }

}

Add a test for your Validator to /tests/Validators/Example.php

Change the way the whole form is assembled
==========================================
Add file with Form name to the /src/Forms directory, e.g. src/Forms/Example
Extend FormInterface 
Add a test for your Validator to /tests/Forms/Example.php