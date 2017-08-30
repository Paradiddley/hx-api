<?php

namespace API\Validation;

class UserValidation extends Validator
{
    /**
     * Rules specified for user related requests
     *
     * @var array
     */
    protected $params = [
        'forename'  => 'alpha',
        'surname'   => 'alpha',
        'email'     => 'email'
    ];
}
