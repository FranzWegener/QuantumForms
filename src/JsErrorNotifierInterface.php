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
     * @return string 'function (elementName, validatorName, errors) { ... }' 
     */
    public function getJsErrorNotifier();
}