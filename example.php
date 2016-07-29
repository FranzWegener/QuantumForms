<?php
use QuantumForms\Forms\Form;
use QuantumForms\JsErrorNotifiers\Alert;
use QuantumForms\FormElements\Input;
use QuantumForms\Validators\Integer;
use QuantumForms\Validators\Alphanumeric;
use QuantumForms\Autoloader;
use QuantumForms\FormElements\Submit;

/**
 * Example Use of QuantumForms
 */

// instantiate the loader
require_once 'src/Autoloader.php';
$loader = new Autoloader();

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('QuantumForms', __DIR__.'/src');

//create Form

$form = new Form('GET', '/', new Alert());

$ageElement = new Input('age');
$ageElement->setValidators([new Integer()]);
$form->addElement($ageElement);

$nameElement = new Input('name');
$nameElement->setValidators([new Alphanumeric()]);
$form->addElement($nameElement);

$submitElement = new Submit('submit');
$form->addElement($submitElement);

echo '<html><head>';
echo $form->renderJavascript();
echo '</head><body>';
echo $form->renderHtml();
echo '</body></html>';