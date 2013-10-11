<?php

namespace matuck\AliasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alias
 *
 * @ORM\Table(name="alias")
 * @ORM\Entity(repositoryClass="matuck\AliasBundle\Entity\AliasRepository")
 */
class Alias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="truepath", type="string", length=255)
     */
    private $truepath;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set alias
     *
     * @param string $alias
     * @return Alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    
        return $this;
    }

    /**
     * Get alias
     *
     * @return string 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set truepath
     *
     * @param string $truepath
     * @return Alias
     */
    public function setTruepath($truepath)
    {
        $this->truepath = $truepath;
    
        return $this;
    }

    /**
     * Get truepath
     *
     * @return string 
     */
    public function getTruepath()
    {
        return $this->truepath;
    }
}