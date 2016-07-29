<?php
namespace QuantumForms\Tests\FormElements;

use QuantumForms\FormElements\Input;

class Input extends \PHPUnit_Framework_TestCase
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
    	$this->element = new Input('test');
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
        $this->element->setType('text');
        $html = $this->element->render();
        $this->standardAssertions($html);
        
        $this->element->addAttribute('data-attrib', 'attributeValue');
        $html = $this->element->render();
        $this->standardAssertions($html);
        $this->assertTrue(isset($attributes['data-attrib']));
        $this->assertTrue(isset($attributes['data-attrib']) && $attributes['data-attrib'] == 'attributeValue');
        
    }
    /**
     * Run standard tests on rendered html of FormElement
     * @param string $html
     */
    protected function standardAssertions($html)
    {
        $this->assertTrue(substr($html, -2) == '/>');
        $this->assertTrue(substr($html, 0, 7) == '<input ');
        $attributes = substr($html, 7, -2);
        $attributes = explode(' ', $attributes);
        $this->assertTrue(isset($attributes['id']));
        $this->assertTrue(isset($attributes['id']) && $attributes['id'] == 'test');
        $this->assertTrue(isset($attributes['name']));
        $this->assertTrue(isset($attributes['name']) && $attributes['name'] == 'test');
        $this->assertTrue(isset($attributes['type']));
        $this->assertTrue(isset($attributes['type']) && $attributes['type'] == 'text');
        $this->assertTrue($this->element->getName() == 'test');
    }
    
}