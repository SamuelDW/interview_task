<?php

declare(strict_types=1);

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class Substance
 * @ORM\Table(name="yordasgrouptask.tblSubstances")
 * @ORM\Entity(repositoryClass="SubstanceRepository")
 */
class Substance
{
    use TimestampableEntity;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var int
     *
     * @ORM\Column(name="intEuropeanCommunityId", nullable=false)
     */
    private int  $europeanCommunityId;

    /**
     * @var int
     *
     * @ORM\Column(name="intCASId", nullable=true)
     */
    private int $casId;

    /**
     * @var array
     *
     * @ORM\ManyToOne(targetEntity="")
     * @ORM\JoinColumn(name="intSubstanceId", referencedColumnName="intSubstanceId")
     */
    private array $substanceNames;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getEuropeanCommunityId(): int
    {
        return $this->europeanCommunityId;
    }

    /**
     * @return int
     */
    public function getCasId(): int
    {
        return $this->casId;
    }
}