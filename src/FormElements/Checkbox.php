<?php
namespace QuantumForms\FormElements;

/**
 * Checkbbox FormElement
 * @author Franz Wegener
 *
 */
class Checkbox extends AbstractFormElement implements \Quantumforms\FormElementInterface
{
    public function render()
    {
        $attributes = $this->getAttributesString();
        return $this->htmlBefore.'<input type="checkbox" '.$attributes.'/>'.$this->htmlAfter;
    }
}