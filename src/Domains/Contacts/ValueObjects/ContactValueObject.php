<?php

declare(strict_types=1);

namespace Domains\Contacts\ValueObjects;

use Infrastructure\Contracts\ValueObjectContract;

final class ContactValueObject implements ValueObjectContract
{
    /**
     * @param null|string $title
     * @param string $firstName
     * @param null|string $middleName
     * @param null|string $lastName
     * @param null|string $prefferedName
     * @param null|string $phone
     * @param null|string $email
     * @param string $pronouns
     */
    public function __construct(
        public null|string $title,
        public string $firstName,
        public null|string $middleName,
        public null|string $lastName,
        public null|string $prefferedName,
        public null|string $phone,
        public null|string $email,
        public string $pronouns,
    ) {}
    
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'first_name' => $this->firstName,
            'middle_name' => $this->middleName,
            'last_name' => $this->lastName,
            'preffered_name' => $this->prefferedName,
            'phone' => $this->phone,
            'email' => $this->email,
            'pronouns' => $this->pronouns,
        ];
    }
}