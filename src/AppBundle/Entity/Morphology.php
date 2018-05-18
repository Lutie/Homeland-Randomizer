<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\AbstractType;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MorphologyRepository")
 * @ORM\Table(name="char_morphologies")
 */
class Morphology extends AbstractType
{

    use IdTrait;

    use NameTrait;

    use DescriptionTrait;

    use RatioTrait;

}
