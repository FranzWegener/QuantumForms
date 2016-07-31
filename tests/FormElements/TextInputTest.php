<?php
namespace QuantumForms\Tests\FormElements;

use QuantumForms\FormElements\TextInput;
use QuantumForms\Autoloader;

require_once 'src/Autoloader.php';
$loader = new Autoloader();

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('QuantumForms', 'src');

class TextInputTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var QuantumForms\FormElementInterface
     */
    public $element;
    
    /**
     * Run before each test is started.
     */
    public function setUp()
    {
    	$this->element = new TextInput('test');
    }
    
    /**
     * Run after each test is completed.
     */
    public function tearDown()
    {}
    
    /**
     * Check that html rendering is correct
     */
    public function testRendering()
    {
        $html = $this->element->render();
        $this->standardAssertions($html);
        
        $this->element->addAttribute('data-attrib', 'attributeValue');
        $html = $this->element->render();
        $this->standardAssertions($html);
        $attributes = $this->extractAttributes($html);
        $this->assertTrue(isset($attributes['data-attrib']), 'data-attrib tag not set');
        $this->assertTrue(isset($attributes['data-attrib']) && $attributes['data-attrib'] == 'attributeValue');
        
    }
    /**
     * 
     */
    protected function extractAttributes($html)
    {
        $rawAttributes = substr($html, 7, -2);
        $rawAttributes = explode(' ', $rawAttributes);
        foreach ($rawAttributes as $rawAttribute) $attributes[substr($rawAttribute, 0, strpos($rawAttribute, '='))] = trim(substr($rawAttribute, strpos($rawAttribute, '=')+1), ' "\'');
        return $attributes;
    }
    /**
     * Run standard tests on rendered html of FormElement
     * @param string $html
     */
    protected function standardAssertions($html)
    {
        $this->assertTrue(substr($html, -2) == '/>', 'input tag closed');
        $this->assertTrue(substr($html, 0, 7) == '<input ', 'input tag start');
        $attributes = $this->extractAttributes($html);
        
        $this->assertTrue(isset($attributes['id']), 'id isset'. serialize($attributes));
        $this->assertTrue(isset($attributes['id']) && $attributes['id'] == 'test', 'id is wrong');
        $this->assertTrue(isset($attributes['name']), 'name isset');
        $this->assertTrue(isset($attributes['name']) && $attributes['name'] == 'test', 'name is wrong');
        $this->assertTrue(isset($attributes['type']), 'type isset');
        $this->assertTrue(isset($attributes['type']) && $attributes['type'] == 'text', 'type is wrong');
        $this->assertTrue($this->element->getName() == 'test', 'name is wrong');
    }
    
}