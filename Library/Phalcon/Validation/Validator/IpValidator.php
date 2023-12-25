<?php

namespace Phalcon\Validation\Validator;

use Phalcon\Filter\Validation;
use Phalcon\Messages\Message;
use Phalcon\Validation\AbstractValidator as Validator;
use Phalcon\Filter\Validation\ValidatorInterface;

class IpValidator extends Validator implements ValidatorInterface
{
    /**
     * Executes the validation
     *
     * @param  Validation $validator
     * @param  string $attribute
     *
     * @return boolean
     */
    public function validate(Validation $validator, $attribute)
    {
        $value = $validator->getValue($attribute);

        if (!filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6)) {
            $message = $this->getOption(
                'message',
                'The IP is not valid'
            );

            $validator->appendMessage(
                new Message($message, $attribute, 'Ip')
            );

            return false;
        }

        return true;
    }
}
