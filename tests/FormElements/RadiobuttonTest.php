<?php
namespace QuantumForms\Tests\FormElements;

use QuantumForms\Autoloader;
use QuantumForms\FormElements\Radiobutton;

require_once 'src/Autoloader.php';
$loader = new Autoloader();

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('QuantumForms', 'src');

class RadiobuttonTest extends \PHPUnit_Framework_TestCase
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
        $this->element = new Radiobutton('test');
        $this->options = ['true' => ['text' => 'Pass', 'isSelected' => true], 'false' => ['text' => 'Fail']];
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
        
        $this->element->setOptions($this->options);
        
        $this->assertTrue($this->element->addOption('unknown', 'unknown', false, true) instanceof Radiobutton);
        $this->assertTrue($this->element->addOptions(['unknown1' => ['text' => 'unknown1', 'isDisabled' => true]]) instanceof Radiobutton);
        $html = $this->element->render();
        
        $this->assertEquals(count($this->options)+2, preg_match_all('/\<input.+?\/\>/', $html, $matches));
        $this->assertEquals(count($this->options)+2, count($matches[0]));
        foreach ($matches[0] as $match){
            $this->standardAssertions($match);
        }
        $this->assertTrue($this->element->setValue('unknown') instanceof Radiobutton);
        $html = $this->element->render();

        $this->assertEquals(count($this->options)+2, preg_match_all('/\<input.+?\/\>/', $html, $matches));
        $this->assertEquals(count($this->options)+2, count($matches[0]));
    }
    /**
     * 
     */
    public function testException()
    {
    if (method_exists($this, 'setExpectedException')) {
            $this->setExpectedException(\Exception::class);
        } elseif (method_exists($this, 'expectException')) {
            $this->expectException(\Exception::class);
        }
        $this->element->addOptions(['unknown1' => ['isDisabled' => true]]);
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
    
        $this->assertTrue(isset($attributes['name']), 'name isset');
        $this->assertTrue(isset($attributes['name']) && $attributes['name'] == 'test', 'name is wrong');
        $this->assertTrue(isset($attributes['type']), 'type isset');
        $this->assertTrue(isset($attributes['type']) && $attributes['type'] == 'radio', 'type is wrong');
        $this->assertTrue(isset($attributes['value']), 'value isset');
        
    }
    /**
     * Extracts attributes from input tag
     */
    protected function extractAttributes($html)
    {
        $rawAttributes = substr($html, 7, -2);
        $rawAttributes = explode(' ', $rawAttributes);
        foreach ($rawAttributes as $rawAttribute) $attributes[substr($rawAttribute, 0, strpos($rawAttribute, '='))] = trim(substr($rawAttribute, strpos($rawAttribute, '=')+1), ' "\'');
        return $attributes;
    }
}