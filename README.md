# QuantumForms
[![Github made-in](https://img.shields.io/badge/Made_In-Berlin-green.svg)](#) [![Build Status](https://travis-ci.org/FranzWegener/QuantumForms.svg?branch=master)](https://travis-ci.org/FranzWegener/QuantumForms) [![Coverage Status](https://coveralls.io/repos/github/FranzWegener/QuantumForms/badge.svg?branch=master)](https://coveralls.io/github/FranzWegener/QuantumForms?branch=master)

QuantumForms is an easily customizable FormBuilder that uses the same validators in frontend and backend.

## Features

 - Standalone: no dependencies, so it is framework independent and no dependency management is needed
 - Easy to use and extend:
   - add a validator by adding a class to the Validators directory (all validators include the frontend and backend part)
   - add a Javascript Form Error handler by adding a js-closure to JsErrorNotifiers
   - add new type of FormElements by adding a class to the FormElementsDirectory
   - exchange the Form-builder itself by adding to the Forms directory
 - low bandwith (only the validators you use are transmitted to client-side)
 - PSR4

## Installation

Installing QuantumForms is incredibly easy with composer
```bash
composer require franzwegener/quantumforms
```

Alternatively, if your project doesn't use `composer` (QuantumForms doesn't have any dependencies, so composer isn't required!), you can simply include and register the autoloader.

```php
require_once $quantumFormsRootPath.'/Autoloader.php';
$loader = new Autoloader();
$loader->register();
```
## Usage


#### Form Definition

1). Instantiate your form

```php
$form = new Form('GET', '/desired/form/action.php', new Alert());
```

2). Define your form elements, and add them to your form. This assumes you've bound your form to the `$form` variable.
```php
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
```

#### Form Rendering

3). Inject the form-object into your view

```html
<html>
	<head>
		<?= $form->renderJavascript(); ?>
	</head>
	<body>
		<?= $form->renderHtml(); ?>
	</body>
</html>
```

## Extending

Extending QuantumForms allows you to use additional elements to your form.


#### Additional Elements
1). Add file with new FormElement name to the `/src/FormElements directory`, e.g. `src/FormElements/Example`

An example extention could look like this:
```php
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
```
Make sure you add your element test in the tests directory, `/tests/FormElements/Example.php`.

If you would like to contribute your element back to the QuantumForms project, consider opening a pull request with your changes.

#### Add Javascript Method to be invoked on a form error

Add file with JsErrorNotifier name to the `/src/JsErrorNotifiers directory`, e.g. `src/JsErrorNotifiers/Example`

```php
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
```
Add a test for your JsErrorNotifier to `/tests/JsErrorNotifiers/Example.php`

#### Additional Validators

Add file with validator name to the `/src/Validators directory`, e.g. `src/Validators/Example`

```php
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
```
Add a test for your Validator to `/tests/Validators/Example.php`

## Help & Support

This project doesn't come with any specific support plan, but I absolutely love helping out where I can. If you encounter any trouble with it at all, please don't hesitate to let me know. Just [open an issue](https://github.com/FranzWegener/QuantumForms/issues) and I'll do what I can.
