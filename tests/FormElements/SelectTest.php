<?php
namespace QuantumForms\Tests\FormElements;

use QuantumForms\Autoloader;
use QuantumForms\FormElements\Select;

require_once 'src/Autoloader.php';
$loader = new Autoloader();

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('QuantumForms', 'src');

class SelectTest extends \PHPUnit_Framework_TestCase
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
        $this->element = new Select('test');
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
        
        $this->assertTrue($this->element->setOptions($this->options) instanceof Select);
        $this->assertTrue($this->element->addOptions(['unknown' => ['text' => 'unknown', 'isDisabled' => true]]) instanceof Select);
        $this->assertTrue($this->element->addOption('unknown1', 'unknown1', false, true) instanceof Select);
        $this->assertTrue($this->element->setMultipleSelect(false) instanceof Select);
        
        $html = $this->element->render();
        
        //test select
        $this->assertEquals(substr($html, 0, 8), '<select ');
        $this->assertEquals(substr($html, -9), '</select>');
        //test options
        $this->assertEquals(count($this->options)+2, preg_match_all('/\<option .+?\<\/option\>/', $html, $matches));
        $this->assertEquals(count($this->options)+2, count($matches[0]));
        foreach ($matches[0] as $match){
            $this->standardAssertionsOptions($match);
        }
        $this->assertTrue($this->element->addOptions(['unknown' => ['text' => 'unknown']]) instanceof Select);
        $this->assertTrue($this->element->setValue('unknown') instanceof Select);
        $this->assertTrue(is_string($this->element->render()));
    }
    
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
    protected function standardAssertionsOptions($html)
    {
        $this->assertTrue(substr($html, -9) == '</option>', 'option tag closed');
        $this->assertTrue(substr($html, 0, 8) == '<option ', 'option tag start');
        $attributes = $this->extractAttributes($html);

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