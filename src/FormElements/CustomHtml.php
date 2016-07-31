<?php
namespace QuantumForms\FormElements;

/**
 * CustomHtml FormElement
 * @author Franz Wegener
 *
 */
class CustomHtml extends AbstractFormElement implements \Quantumforms\FormElementInterface
{
    protected $formElement;
    
    public function render()
    {
        $attributes = $this->getAttributesString();
        return $this->htmlBefore.$this->formElement.$this->htmlAfter;
    }
    /**
     * Sets the html for this element
     * @param string $html
     */
    public function setHtml($html)
    {
        $this->formElement = $html;
    }
}