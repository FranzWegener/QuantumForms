<?php
namespace QuantumForms\Tests\Validators;

use QuantumForms\Autoloader;
use QuantumForms\Validators\Integer;

require_once 'src/Autoloader.php';
$loader = new Autoloader();

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('QuantumForms', 'src');

class IntegerTest extends \PHPUnit_Framework_TestCase
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
        $this->element = new Integer();
    }

    /**
     * Run after each test is completed.
     */
    public function tearDown()
    {}

    /**
     * Check that html rendering is correct
     */
    public function testValidation()
    {
        $this->assertTrue($this->element->validate(1));
        $this->assertTrue($this->element->validate(123));
        $this->assertTrue($this->element->validate('123'));
        $this->assertTrue(!$this->element->validate('a'));
        $this->assertTrue(!$this->element->validate([1]));
        $this->assertTrue(!$this->element->validate([1,2,3]));
        $this->assertTrue(!$this->element->validate(new \stdClass()));
    }
    
    public function testJsFunctionIsFunction()
    {
        $this->assertTrue((bool)preg_match('/function[\W]*?\([\Wa-zA-Z0-9_]*?\)[\W]*?\{.*\}/s',$this->element->getJavascriptValidator()));
    }
    public function testGetName()
    {
    	$this->assertEquals($this->element->getName(), 'Integer');
    }
}