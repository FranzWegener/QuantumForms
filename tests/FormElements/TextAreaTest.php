<?php
namespace QuantumForms\Tests\FormElements;

use DOMDocument;
use QuantumForms\FormElements\Input;
use QuantumForms\Autoloader;
use QuantumForms\FormElements\TextArea;
use QuantumForms\Validators\Integer;
use QuantumForms\Validators\IsEmpty;

require_once 'src/Autoloader.php';
$loader = new Autoloader();

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('QuantumForms', 'src');

class TextAreaTest extends \PHPUnit_Framework_TestCase
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
        $this->element = new TextArea('test', 'default');
        $this->element->setAttributes(['class' => 'form-control']);
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
        $this->assertTrue($this->element->setAttributes([]) instanceof TextArea);
        $this->assertTrue($this->element->addAttribute('data-attrib', 'attributeValue') instanceof TextArea);
        $html = $this->element->render();
        $this->standardAssertions($html);
        $attributes = $this->extractAttributes($html);
        $this->assertTrue(isset($attributes['data-attrib']), 'data-attrib tag not set');
        $this->assertTrue(isset($attributes['data-attrib']) && $attributes['data-attrib'] == 'attributeValue');

        $this->assertTrue($this->element->setHtmlBefore('<div>') instanceof TextArea);
        $this->assertTrue($this->element->setHtmlAfter('</div>') instanceof TextArea);
        $html = $this->element->render();
        $this->assertEquals(substr($html, 0, 5), '<div>');
        $this->assertEquals(substr($html, -6), '</div>');
        $this->assertTrue($this->element->setValidators([]) instanceof TextArea);
        $this->assertTrue($this->element->addValidator(new IsEmpty()) instanceof TextArea);

        $this->assertEquals($this->element->validateInput(''), true);
        $this->assertEquals($this->element->validateInput('default'), false);
    }

    /**
     *
     */
    protected function extractAttributes($html)
    {

        $dom = new DOMDocument;
        $dom->loadHTML($html);
        $node = $dom->getElementsByTagName('textarea')->item(0);
        $attributes = [];
        foreach($node->attributes as $attr) {
            $attributes[$attr->name] = $attr->value;
        }
        return $attributes;
    }
    /**
     * Run standard tests on rendered html of FormElement
     * @param string $html
     */
    protected function standardAssertions($html)
    {
        $this->assertTrue(substr($html, -10) == '/textarea>', 'element tag closed');
        $this->assertTrue(substr($html, 0, 9) == '<textarea', 'element tag start');
        $attributes = $this->extractAttributes($html);

        $this->assertTrue(isset($attributes['id']), 'id isset'. serialize($attributes));
        $this->assertTrue(isset($attributes['id']) && $attributes['id'] == 'test', 'id is wrong');
        $this->assertTrue(isset($attributes['name']), 'name isset');
        $this->assertTrue(isset($attributes['name']) && $attributes['name'] == 'test', 'name is wrong');
        $this->assertTrue(isset($attributes['class']), 'class isset');
        $this->assertTrue(isset($attributes['class']) && $attributes['class'] == 'form-control', 'class is wrong');
        $this->assertTrue($this->element->getName() == 'test', 'name is wrong');
    }

}