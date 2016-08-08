<?php
namespace QuantumForms\Tests\FormElements;

use QuantumForms\FormElements\CustomHtml;
use QuantumForms\Autoloader;

require_once 'src/Autoloader.php';
$loader = new Autoloader();

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('QuantumForms', 'src');

class CustomHtmlTest extends \PHPUnit_Framework_TestCase
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
        $this->element = new CustomHtml('test');
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
        $testHtml = '<testhtml>This is a test</testhtml>';
        $testPrefixedHtml = '<div>';
        $testSuffixedHtml = '</div>';
        $this->element->setHtml($testHtml);
        $this->element->setHtmlBefore($testPrefixedHtml);
        $this->element->setHtmlAfter($testSuffixedHtml);
        
        $html = $this->element->render();
        $this->assertEquals($html, $testPrefixedHtml.$testHtml.$testSuffixedHtml);
        $this->assertEquals($this->element->getName(), 'test');

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


}