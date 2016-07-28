<?php
namespace QuantumForms;
/**
 * QuantumForms
 * --------
 * = frontend and backend validation combined
 * - standalone: few to no dependencies (only JQuery right now), because I want to be framework independent and don't want to have to manage changes in dependencies (jQuery is okay, because it wraps changes in browsers)
 * - easy to use and easy to extend
 * - low bandwith (only the validators you use should be transmitted to client-side)
 * - PSR4
 * 
 * @author non-admin
 *
 */
interface FormInterface
{
    public function __construct($method, $action, JsErrorNotifierInterface $jsErrorNotifier);
    
    public function addAttribute($name, $value);
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
}
