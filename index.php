<?php
namespace QuantumForms;

use QuantumForms\Forms\Form;
use QuantumForms\JsErrorNotifiers\Alert;
use QuantumForms\FormElements\Input;
use QuantumForms\Validators\Integer;
use QuantumForms\Validators\Alphanumeric;

// instantiate the loader
require_once 'Autoloader.php';
$loader = new Autoloader;

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('QuantumForms', __DIR__);

//create Form

$form = new Form('GET', '/', new Alert());

$ageElement = new Input('age');
$ageElement->setValidators([new Integer()]);
$form->addElement($ageElement);

$nameElement = new Input('name');
$nameElement->setValidators([new Alphanumeric()]);
$form->addElement($nameElement);

echo '<html><head><script src="https://code.jquery.com/jquery-3.1.0.js" integrity="sha256-slogkvB1K3VOkzAI8QITxV3VzpOnkeNVsKvtkYLMjfk=" crossorigin="anonymous"></script>';
echo $form->renderJavascript();
echo '</head><body>';
echo $form->renderHtml();
echo '</body></html>';