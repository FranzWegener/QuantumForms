<?php
namespace QuantumForms;
/**
 * QuantumForms
 * --------
 * QuantumForms is a FormBuilder that uses the same validators in frontend and backend.
 * - standalone: no dependencies, so it is framework independent and no dependency management is needed
 * - easy to use and easy to extend
 *   - add a validator by adding a class to the Validators directory (all validators include the frontend and backend part)
 *   - add a Javascript Form Error handler by adding a js-closure to JsErrorNotifiers
 *   - add new type of FormElements by adding a class to the FormElementsDirectory
 *   - exchange the Form-builder itself by adding to the Forms directory 
 * - low bandwith (only the validators you use are transmitted to client-side)
 * - PSR4
 * 
 * @author Franz Wegener
 *
 */
interface FormInterface
{
    /**
     * Constructor
     * @param string $method Form method
     * @param string $action Form action
     * @param JsErrorNotifierInterface $jsErrorNotifier
     */
    public function __construct($method, $action, JsErrorNotifierInterface $jsErrorNotifier);
    
    /**
     * Add attribute to <form> tag
     * @param string $name
     * @param string $value
     */
    public function addAttribute($name, $value);
    /**
     * Set all attributes to <form> tag
     * @param array $attributes
     */
    public function setAttributes(array $attributes);
    /**
     * Add a FormElement
     * @param FormElementInterface $element
     * @param string $id
     */
    public function addElement(FormElementInterface $element, $id = '');
    /**
     * Set if jquery is available.
     * @param boolean $boolean
     */
    public function setJqueryAvailable($boolean);
    /**
     * Renders the Form's HTML
     * @return string
     */
    public function renderHtml();
    /**
     * Renders the Form's Javascript
     * @return string
     */
    public function renderJavascript();
    /**
     * Set html to be put before the form start
     * @param string $string
     */
    public function setHtmlBefore($string);
    /**
     * Set html to be put after the form start
     * @param string $string
     */
    public function setHtmlAfter($string);
    /**
     * Executes Server-Side Validation
     * @param array $request
     * @return boolean
     */
    public function validateInput(array $request);
    /**
     * Populates the form fields with the key-value-pairs in the $formValues array
     * @param array $formValues
     * @return $this
     */
    public function populate(array $formValues);
}
