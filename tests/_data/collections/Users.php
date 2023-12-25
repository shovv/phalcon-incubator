<?php

namespace Phalcon\Test\Collections;

use Phalcon\Mvc\MongoCollection;
use Phalcon\Filter\Validation;
use Phalcon\Filter\Validation\Validator\Email;
use Phalcon\Filter\Validation\Validator\ExclusionIn;
use Phalcon\Filter\Validation\Validator\InclusionIn;
use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Filter\Validation\Validator\Regex;
use Phalcon\Filter\Validation\Validator\StringLength;
use Phalcon\Filter\Validation\Validator\Uniqueness;

class Users extends MongoCollection
{
    public function validation()
    {
        $validator = new Validation();
        $validator
            ->add('created_at', new PresenceOf())

            ->add('email', new StringLength(['min' => '7', 'max' => '50']))
            ->add('email', new Email())
            ->add('email', new Uniqueness())

            ->add('status', new ExclusionIn(['domain' => ['P', 'I', 'w']]))
            ->add('status', new InclusionIn(['domain' => ['A', 'y', 'Z']]))
            ->add('status', new Regex(['pattern' => '/[A-Z]/']));

        return $this->validate($validator);
    }
}