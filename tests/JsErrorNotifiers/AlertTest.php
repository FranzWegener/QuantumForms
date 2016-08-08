<?php
namespace QuantumForms\Tests\Validators;

use QuantumForms\Autoloader;
use QuantumForms\JsErrorNotifiers\Alert;

require_once 'src/Autoloader.php';
$loader = new Autoloader();

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('QuantumForms', 'src');

class AlertTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var QuantumForms\FormElementInterface
     */
    public $element;
    /**
     * Options set for the radio buttons
     * @var array
     */
    protected $options;

    /**
     * Run before each test is started.
     */
    public function setUp()
    {
        $this->element = new Alert();
    }

    /**
     * Run after each test is completed.
     */
    public function tearDown()
    {}

    public function testJsFunctionIsFunction()
    {
        $this->assertTrue((bool)preg_match('/function[\W]*?\([\W,a-zA-Z0-9]*?\)[\W]*?\{.*\}/s',$this->element->getJsErrorNotifier()));
    }
}