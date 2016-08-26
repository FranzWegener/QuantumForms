<?php
namespace QuantumForms\Tests\Validators;

use QuantumForms\Autoloader;
use QuantumForms\FormElementInterface;
use QuantumForms\Validators\IsNotEmpty;

require_once 'src/Autoloader.php';
$loader = new Autoloader();

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('QuantumForms', 'src');

class IsNotEmptyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FormElementInterface
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
        $this->element = new IsNotEmpty();
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
        $this->assertFalse(!$this->element->validate(1));
        $this->assertFalse(!$this->element->validate(123));
        $this->assertFalse(!$this->element->validate('123'));
        $this->assertFalse(!$this->element->validate('asd_hgf'));
        $this->assertFalse(!$this->element->validate('aB6454Z'));
        $this->assertTrue($this->element->validate('aB64 54Z'));
        $this->assertTrue($this->element->validate([1]));
        $this->assertTrue($this->element->validate([1,2,3]));
        $this->assertTrue($this->element->validate(new \stdClass()));
        $this->assertFalse($this->element->validate(''));
        $this->assertFalse($this->element->validate(null));
        $this->assertFalse($this->element->validate([]));
    }

    public function testJsFunctionIsFunction()
    {
        $this->assertTrue((bool)preg_match('/function[\W]*?\([\Wa-zA-Z0-9_]*?\)[\W]*?\{.*\}/s',$this->element->getJavascriptValidator()));
    }
    public function testGetName()
    {
        $this->assertTrue((bool)preg_match('/^IsNotEmpty+$/', $this->element->getName()));
    }
}