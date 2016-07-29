<?php
namespace QuantumForms\FormElements;

/**
 * Input FormElement
 * @author Franz Wegener
 *
 */
class TextInput extends AbstractFormElement implements \Quantumforms\FormElementInterface
{
    /**
     * Sets the name of the FormElement
     * @param string $name
     */
    public function __construct($name)
    {
    	$this->attributes['type'] = 'text';
    	parent::__construct($name);
    }
    /**
     * (non-PHPdoc)
     * @see \QuantumForms\FormElements\AbstractFormElement::render()
     */
    public function render()
    {
        $attributes = $this->getAttributesString();
    	return $this->htmlBefore.'<input '.$attributes.'/>'.$this->htmlAfter;
    }    
}