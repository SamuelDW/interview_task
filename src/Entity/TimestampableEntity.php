<?php


namespace App\Entity;


use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

trait TimestampableEntity
{
    /**
     * @var Carbon
     *
     * @ORM\Column(name="dtmCreated", nullable=false)
     */
    private Carbon $dtmCreated;

    /**
     * @var Carbon
     *
     * @ORM\Column(name="dtmUpdated", nullable=true)
     */
    private Carbon $dtmUpdated;

}