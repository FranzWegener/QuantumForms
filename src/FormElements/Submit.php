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
        return $this->htmlBefore.'<input type="submit" '.$attributes.'/>'.$this->htmlAfter;
    }
}