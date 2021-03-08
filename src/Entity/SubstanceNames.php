<?php

declare(strict_types=1);

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

class SubstanceNames
{
    /**
     * @var int
     *
     * @ORM\Column(name="intNameId")
     * @ORM\GeneratedValue(strategy="")
     * @ORM\Id()
     */
    private int $id;

    /**
     * @var array
     *
     * @ORM\Column(name="strSubstanceName")
     */
    private array $substanceName;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="App/Entity/Substance")
     * @ORM\JoinColumn(name="intSubstanceId", referencedColumnName="intSubstanceId")
     */
    private int $substanceId;

    public function __construct(string $substanceName, int $substanceId)
    {
        //TODO setup constructor, repository to get all names for an individual substance.
    }

    /**
     * @return array
     */
    public function getSubstanceNames(): array
    {
        return $this->substanceNames;
    }
}