<?php
namespace QuantumForms\FormElements;

/**
 * Input FormElement
 * @author Franz Wegener
 *
 */
class Submit extends AbstractFormElement implements \Quantumforms\FormElementInterface
{
    public function render()
    {
        $attributes = $this->getAttributesString();
        if (!empty($this->value)) $attributes.= ' value="'.$this->value.'"';
        return $this->htmlBefore.'<input type="submit" '.$attributes.'/>'.$this->htmlAfter;
    }
}