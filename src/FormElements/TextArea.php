<?php

namespace QuantumForms\FormElements;

/**
 * Class TextArea
 * @author Zac Brown
 * @package QuantumForms\FormElements
 */
class TextArea extends AbstractFormElement implements \Quantumforms\FormElementInterface
{
    /**
     * (non-PHPdoc)
     * @see \QuantumForms\FormElements\AbstractFormElement::render()
     */
    public function render()
    {
        $attributes = $this->getAttributesString();
        return $this->htmlBefore.'<textarea '.$attributes.'>'.$this->value.'</textarea>'.$this->htmlAfter;
    }
}