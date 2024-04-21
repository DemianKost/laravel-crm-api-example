<?php

declare(strict_types=1);

namespace Domains\Interactions\ValueObjects;
use Infrastructure\Contracts\ValueObjectContract;

class InteractionValueObject implements ValueObjectContract
{
    /**
     * @param string $type
     * @param int $contact
     * @param null|string $content
     * @param null|int $project
     */
    public function __construct(
        public string $type,
        public int $contact,
        public null|string $content = null,
        public null|int $project = null,
    ) {}

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'content' => $this->content,
            'contact_id' => $this->contact,
            'project_id' => $this->project,
        ];
    }
}