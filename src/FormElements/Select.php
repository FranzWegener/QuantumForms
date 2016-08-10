<?php
namespace QuantumForms\FormElements;
/**
 * Select FormElement
 * @author Franz Wegener
 *
 */
class Select extends AbstractFormElement implements \Quantumforms\FormElementInterface
{
    protected $options = [];
    protected $isMultiSelect = false;
    
    /**
     * (non-PHPdoc)
     * @see \QuantumForms\FormElements\AbstractFormElement::render()
     */
    public function render()
    {
        $attributes = $this->getAttributesString();
        $select = '<select ';
        if ($this->isMultiSelect) $select.= 'multiple ';
        $select.= $attributes.'>';
        $select.= $this->renderOptions(); 
        $select.='</select>';
        return $this->htmlBefore.$select.$this->htmlAfter;
    }
    /**
     * Returns options html string
     * @return string
     */
    protected function renderOptions()
    {
        $options = '';
        foreach ($this->options as $optionValue => $option){
        	$options.= '<option value="'.$optionValue.'"';
        	if (isset($option['isSelected']) && $option['isSelected']) $options.= ' selected';
        	if (isset($option['isDisabled']) && $option['isDisabled']) $options.= ' disabled';
        	if (isset($option['label']) && $option['label']) $options.= ' label="'.$options['label'].'"';
        	$options.= '>'.$option['text'].'</option>';
        }
    	return $options;
    }
    /**
     * Adds an option to the select
     * @param string $value
     * @param string $text
     * @param bool $default
     * @return $this
     */
    public function addOption($value, $text, $selected=false, $disabled=false, $label = null)
    {
        $this->options[$value]['text'] = $text;
        $this->options[$value]['isSelected'] = $selected;
        $this->options[$value]['isDisabled'] = $disabled;
        if ($label != null) $this->options[$value]['label'] = $label;
        return $this;
    }
    /**
     * Set all options
     * @param array $options Structure of $options must be [$valueTagName =>[\'text\' => User Readable option name, \'isSelected\'(optional) => bool, \'isDisabled\'(optional) => bool, \'label\'(optional) => string]], ...]
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
     * @param array $options Structure of $options must be [$valueTagName =>[\'text\' => User Readable option name, \'isSelected\'(optional) => bool, \'isDisabled\'(optional) => bool, \'label\'(optional) => string]], ...]
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
            if (!is_string($optionValue) && !is_integer($optionValue)) throw new \Exception('The key of the $options array must be the option value tags.');
            if (!isset($option['text'])) throw new \Exception ('Structure of $options must be [$valueTagName =>[\'text\' => User Readable option name, \'isSelected\'(optional) => bool, \'isDiabled\'(optional) => bool, \'label\'(optional) => string]], ...]');
        }
    }
    /**
     * 
     * @param boolean $bool
     */
    public function setMultipleSelect($bool)
    {
        $this->isMultiSelect = $bool;
        return $this;
    }
}