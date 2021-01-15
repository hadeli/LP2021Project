<?php


namespace App\Validator;


/**
 * @Annotation
 */
class IsBelowContainershipLimit extends \Symfony\Component\Validator\Constraint
{
    public $message = "Reaching the limit of containership.";

    /**
     * @return string
     */
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}