<?php 

namespace App\Model\Validation;

use App\Libs\ConfigUtil;
use Cake\Validation\Validator;
use Cake\Validation\Validation;
use Cake\Validation\ValidationRule;

/**
 * Help add custom validation message
 */
class AppValidator extends Validator {

    // Used to generate validation message
    private $_labels = [];

    /**
     * Add a validation rule for a field
     * @param string $field field name
     * @param string $rule validation rule
     * @param string $label field label, used to generate user friendly validation message 
     * @return void 
     */
    public function extend($field, $rule, $label = null) {
        switch($rule) {
            case 'email':
                $this->addEmailField($field, $label??$field);
                break;
            case 'required':
                $this->addRequiredField($field, $label??$field);
                break;
            case 'integer':
                $this->addIntegerField($field, $label??$field);
                break;
            default:
                break;
        }
    }

    /**
     * Add 'email field' validation
     * @param field field name
     * @param label field label 
     * @return void 
     */
    private function addEmailField($field, $label) {
        // add rule
        $this->add($field, 'custom', [
            'rule' => function ($value) {
                if (Validation::email($value)) {
                    return true;
                }
                return ConfigUtil::getMessage('E004');
            },
        ]);
        // add label
        $this->_labels[$field] = $label??$field;
    }

    /**
     * Add 'required field' validation
     * @param field field name
     * @param label field label 
     * @return void 
     */
    private function addRequiredField($field, $label) {
        // add rule
        $this->add($field, 'custom', [
            'rule' => [$this, 'validateRequiredField'],
        ]);
        // add label
        $this->_labels[$field] = $label??$field;
    }

    /**
     * Add 'integer field' validation
     * @param field field name
     * @param label field label 
     * @return void 
     */
    private function addIntegerField($field, $label) {
        // add rule
        $this->add($field, 'custom', [
            'rule' => [$this, 'validateIntegerField'],
        ]);
        // add label
        $this->_labels[$field] = $label??$field;
    }



    /**
     * Custom validate function for 'required' field.
     */
    public function validateRequiredField($value, $context) {
        if ($value) {
            return true;
        }
        return ConfigUtil::getMessage('E001', [$this->_labels[$context['field']]]);
    }

     /**
     * Custom validate function for 'integer' field.
     */
    public function validateIntegerField($value, $context) {
        if (Validation::isInteger($value)) {
            return true;
        }
        return ConfigUtil::getMessage('E012', [$this->_labels[$context['field']], 'digits']);
    }
}