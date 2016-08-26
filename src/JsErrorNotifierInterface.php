<?php
namespace QuantumForms;
/**
 * Interface for JsErrorNotifiers
 * @author Franz Wegener
 *
 */
interface JsErrorNotifierInterface
{
    /**
     * @return string 'function (elementName, errors) { ... }',
     * where elementName is a string and errors is a Js-Object of the structure errors = ['ValidatorName' => 'ErrorMessage', ...];
     */
    public function getJsErrorNotifier();
}