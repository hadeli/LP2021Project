<?php


namespace App\Validator;


use Symfony\Component\Validator\Constraint;

class IsBelowContainershipLimitValidator extends \Symfony\Component\Validator\ConstraintValidator
{

    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint)
    {
        if ($value == null ||$value == '') {
            return;
        }


    }
}