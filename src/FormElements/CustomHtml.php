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

    /**
     * {value} will be replaced with set value or empty string
     * @return string
     */
    public function render()
    {
        $this->formElement = str_replace('{value}', $this->value, $this->formElement);
        return $this->htmlBefore.$this->formElement.$this->htmlAfter;
    }
    /**
     * Sets the html for this element, should you want to autopopulate this field, put {value} as a placeholder
     * If value is empty (set using ->setValue) the placeholder will be replaced with an empty string.
     * @param string $html
     */
    public function setHtml($html)
    {
        $this->formElement = $html;
    }
}