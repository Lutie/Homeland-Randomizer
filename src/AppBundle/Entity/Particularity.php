<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\AbstractType;

/**
 * @ORM\Entity()
 * @ORM\Table(name="char_particularities")
 */
class Particularity extends AbstractType
{

    use IdTrait;

    use NameTrait;

    use DescriptionTrait;

    use RatioTrait;

}
