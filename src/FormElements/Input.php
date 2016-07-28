<?php
namespace QuantumForms\FormElements;

/**
 * Input FormElement
 * @author Franz Wegener
 *
 */
class Input extends AbstractFormElement implements \Quantumforms\FormElementInterface
{
    public function render()
    {
        $attributes = $this->getAttributesString();
    	return $this->htmlBefore.'<input '.$attributes.'/>'.$this->htmlAfter;
    }    
}