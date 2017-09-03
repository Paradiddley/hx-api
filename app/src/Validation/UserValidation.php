<?php

namespace API\Validation;

use Respect\Validation\Validator as V;

class UserValidation extends Validator
{
    protected function forenameRule()
    {
        return V::alpha();
    }

    protected function surnameRule()
    {
        return V::alpha();
    }

    protected function emailRule()
    {
        return V::email();
    }

    protected function searchTermRule()
    {
        return V::oneOf(V::alpha(), V::email());
    }

    protected function searchFieldRule()
    {
        return V::in(['forename', 'surname', 'email']);
    }
}
