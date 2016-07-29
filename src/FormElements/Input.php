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
    /**
     * Sets the type of the input
     * @param string $type
     */
    public function setType($type)
    {
    	$this->attributes['type'] = $type;
    }    
}