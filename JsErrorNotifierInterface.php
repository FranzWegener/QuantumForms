<?php
namespace QuantumForms;

interface JsErrorNotifierInterface
{
    /**
     * @return string 'validatorError(elementName, validatorName){ ... }' 
     */
    public function getJsErrorNotifier();
}