<?php

declare(strict_types=1);

namespace App\ValueObjects;

final class ContactValueObject
{
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