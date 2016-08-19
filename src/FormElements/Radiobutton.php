<?php
namespace QuantumForms\FormElements;

/**
 * Radiobutton FormElement
 * @author Franz Wegener
 *
 */
class Radiobutton extends AbstractFormElement implements \Quantumforms\FormElementInterface
{
    protected $options;
    
    /**
     * Use name as identifying attribute by default, because id doesn't work on Radiobuttons
     * @param string $name
     */
    public function __construct($name){
    	parent::__construct($name);
    	$this->setIdentifyingAttribute('name');
    }
    /**
     * (non-PHPdoc)
     * @see \QuantumForms\FormElements\AbstractFormElement::render()
     */
    public function render()
    {
        $attributes = $this->getAttributesString();
        
        $options = '';
        foreach ($this->options as $optionValue => $option){
            $options.= '<input type="radio" name="'.$this->getName().'" value="'.$optionValue.'"';
            if (!empty($attributeString)) $options.= ' '.$attributeString;
            if ($this->isSelected($optionValue, $option)) $options.= ' checked="checked"';
            if (isset($option['isDisabled']) && $option['isDisabled']) $options.= ' disabled="disabled"';
            $options.= '/> '.$option['text'].'<br/>';
        }
        
        return $this->htmlBefore.$options.$this->htmlAfter;
    }
    
    /**
     * Adds an option to the select
     * @param string $value
     * @param string $text
     * @param bool $default
     * @return $this
     */
    public function addOption($value, $text, $selected=false, $disabled=false)
    {
        $this->options[$value]['text'] = $text;
        $this->options[$value]['isSelected'] = $selected;
        $this->options[$value]['isDisabled'] = $disabled;
        return $this;
    }
    /**
     * Set all options
     * @param array $options Structure of $options must be [$valueTagName =>[\'text\' => User Readable option name, \'isSelected\'(optional) => bool, \'isDisabled\'(optional) => bool]], ...]
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->checkOptionsArray($options);
        $this->options = $options;
        return $this;
    }
    /**
     * Add array of options overwriting duplicates
     * @param array $options Structure of $options must be [$valueTagName =>[\'text\' => User Readable option name, \'isSelected\'(optional) => bool, \'isDisabled\'(optional) => bool], \'label\'(optional) => string]], ...]
     * @return \QuantumForms\FormElements\Select
     */
    public function addOptions(array $options)
    {
        $this->checkOptionsArray($options);
        $this->options = array_merge($this->options, $options);
        return $this;
    }
    /**
     * Checks if the options array is well-formed and throws an Exception if not
     * @param array $options
     * @throws \Exception
     */
    protected function checkOptionsArray(array $options)
    {
        foreach ($options as $optionValue => $option){
            if (!isset($option['text'])) throw new \Exception ('Structure of $options must be [$valueTagName =>[\'text\' => User Readable option name, \'isSelected\'(optional) => bool, \'isDiabled\'(optional) => bool]], ...]');
        }
    }

    /**
     * @param $optionValue
     * @param array $option
     * @return bool
     */
    protected function isSelected($optionValue, array $option)
    {
        if (isset($option['isDisabled']) && $option['isDisabled']) return false;
        if (!empty($this->value)){
            if ($this->value !== $optionValue) return false;
            return true;
        }
        return (isset($option['isSelected']) && $option['isSelected']);
    }
}