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
     * @return string 'validatorError(elementName, validatorName){ ... }' 
     */
    public function getJsErrorNotifier();
}