<?php

namespace QuantumForms\FormElements;

/**
 * Class TextArea
 * @author Zac Brown
 * @package QuantumForms\FormElements
 */
class TextArea extends AbstractFormElement implements \Quantumforms\FormElementInterface {

    /**
     * The default text in the textarea
     *
     * @var string
     */
    private $defaultText;

    /**
     * TextArea constructor.
     * @param string $name
     * @param string $previewText
     */
    public function __construct($name, $previewText = '') {

        $this->defaultText = $previewText;
        parent::__construct($name);
    }

    /**
     * (non-PHPdoc)
     * @see \QuantumForms\FormElements\AbstractFormElement::render()
     */
    public function render() {
        $attributes = $this->getAttributesString();
        return $this->htmlBefore.'<textarea '.$attributes.'>'.$this->defaultText.'</textarea>'.$this->htmlAfter;
    }
}