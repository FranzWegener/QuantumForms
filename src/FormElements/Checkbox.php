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
        if ($this->value !== null && $this->value == false) unset($this->attributes['checked']);
        if ($this->value == true) $this->attributes['checked'] = 'checked';
        $attributes = $this->getAttributesString();
        return $this->htmlBefore.'<input type="checkbox" '.$attributes.'/>'.$this->htmlAfter;
    }
}