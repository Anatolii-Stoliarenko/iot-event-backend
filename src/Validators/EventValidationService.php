<?php

namespace App\Validators;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class EventValidationService
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    //Base validation eventType & deviceId
    public function validateBaseData(array $data): ConstraintViolationListInterface
    {
        $baseConstraints = new Assert\Collection([
            'eventType' => new Assert\Choice(['choices' => ['deviceMalfunction', 'temperatureExceeded', 'doorUnlocked']]),
            'deviceId' => [
                new Assert\NotBlank(),
                new Assert\Type(['type' => 'string'])
            ],
            'eventDate' => [
                new Assert\NotBlank(),
                new Assert\Type(['type' => 'integer'])
            ],
            // Opcjonalne pola, które zostaną walidowane w zależności od eventType
            'reasonCode' => new Assert\Optional(),
            'reasonText' => new Assert\Optional(),
            'temp' => new Assert\Optional(),
            'treshold' => new Assert\Optional(),
            'unlockDate' => new Assert\Optional()
        ]);

        return $this->validator->validate($data, $baseConstraints);
    }

    //Specific validation for deviceMalfunction || temperatureExceeded || doorUnlocked
    public function validateSpecificData(array $data): ConstraintViolationListInterface
    {
        if (!isset($data['eventType'])) {
            return [];
        }

        $specificConstraint = null;
        switch ($data['eventType']) {
            case 'deviceMalfunction':
                $specificConstraint = new Assert\Collection([
                    'fields' => [
                        'reasonCode' => [
                            new Assert\NotBlank(),
                            new Assert\Type(['type' => 'integer'])
                        ],
                        'reasonText' => [
                            new Assert\NotBlank(),
                            new Assert\Type(['type' => 'string'])
                        ]
                    ],
                    'allowExtraFields' => true, // Akceptuje dodatkowe pola
                ]);
                break;

                case 'temperatureExceeded':
                    $specificConstraint = new Assert\Collection([
                        'fields' => [
                            'temp' => [
                                new Assert\NotBlank(),
                                new Assert\Callback(function ($value, $context) {
                                    if (!is_numeric($value)) {
                                        $context->buildViolation('This value should be a valid float.')
                                            ->addViolation();
                                    }
                                })
                            ],
                            'treshold' => [
                                new Assert\NotBlank(),
                                new Assert\Callback(function ($value, $context) {
                                    if (!is_numeric($value)) {
                                        $context->buildViolation('This value should be a valid float.')
                                            ->addViolation();
                                    }
                                })
                            ]
                        ],
                        'allowExtraFields' => true, // Akceptuje dodatkowe pola
                    ]);
                    break;

            case 'doorUnlocked':
                $specificConstraint = new Assert\Collection([
                    'fields' => [
                        'unlockDate' => [
                            new Assert\NotBlank(),
                            new Assert\Type(['type' => 'integer'])
                        ]
                    ],
                    'allowExtraFields' => true, // Akceptuje dodatkowe pola
                ]);
                break;
        }

        return $specificConstraint ? $this->validator->validate($data, $specificConstraint) : [];
    }
}
