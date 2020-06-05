<?php

namespace App\Dto;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Happyr\Validator\Constraint\EntityExist;

class UpdateTestDto
{
    /**
     * @Assert\NotBlank(allowNull = true)
     * @Assert\Length(max = 255)
     * @Serializer\Type("string")
     */
    private ?string $question;

    /**
     * @Assert\NotBlank
     * @Assert\Length(max = 255)
     * @Assert\Type("string")
     * @Serializer\Type("string")
     */
    private string $answer;

    /**
     * @Assert\Type(type = "array")
     * @Serializer\Type("array")
     */
    private ?array $hints;

    /**
     * @Assert\Length(max = 255)
     * @Assert\Url
     * @Assert\Type("string")
     * @Serializer\Type("string")
     */
    private string $imageUrl = '';

    /**
     * @Assert\NotBlank
     * @Assert\Type("integer")
     * @EntityExist(entity="App\Entity\City")
     * @Serializer\Type("integer")
     */
    private int $cityId;

    /**
     * @return string|null
     */
    public function getQuestion(): ?string
    {
        return $this->question;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * @return array|null
     */
    public function getHints(): array
    {
        return $this->hints ?? [];
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @return int
     */
    public function getCityId(): int
    {
        return $this->cityId;
    }
}
