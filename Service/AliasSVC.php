<?php
namespace matuck\AliasBundle\Service;

use Symfony\Component\DependencyInjection\ContainerAware;
use matuck\AliasBundle\Entity\Alias;
use matuck\AliasBundle\Exception\DuplicateAliasException;

/**
 * Description of Alias
 *
 * @author matuck
 */
class AliasSVC extends ContainerAware
{
    protected $container;
    
    public function __construct($container)
    {
        $this->container = $container;
    }
    
    /**
     * 
     * @param type $alias
     * @param type $truepath
     * @return boolean
     * @throws \InvalidArgumentException
     * @throws DuplicateAliasException
     */
    public function createAlias($alias, $truepath)
    {
        if($alias == '' || $alias == NULL)
        {
            throw new \InvalidArgumentException('Alias cannot be null or empty');
        }
        if($truepath == '' || $truepath == NULL)
        {
            throw new \InvalidArgumentException('Truepath cannot be null or empty');
        }
        $em = $this->container->get('Doctrine')->getManager();
        /* @var $em \Doctrine\ORM\EntityManager */
        if($oldalias = $em->getRepository('matuckAliasBundle:Alias')->findOneBy(array('alias' => $alias)))
        {
            throw new DuplicateAliasException(sprintf('The alias %s already exists and points to %s', $alias, $oldalias->getTruepath()));
        }
        $newalias = new Alias();
        $newalias->setAlias($alias);
        $newalias->setTruepath($truepath);
        $em->persist($newalias);
        $em->flush();
        return true;
    }
    
    /**
     * 
     * @param type $alias
     * @return boolean
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function deleteAlias($alias)
    {
        $em = $this->container->get('Doctrine')->getManager();
        /* @var $em \Doctrine\ORM\EntityManager */
        if($oldalias = $em->getRepository('matuckAliasBundle:Alias')->findOneBy(array('alias' => $alias)))
        {
            $em->remove($oldalias);
            $em->flush();
            return true;
        }
        throw new \Doctrine\ORM\EntityNotFoundException();
    }
    
    /**
     * 
     * @param type $alias
     * @return type
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getTruepath($alias)
    {
        $em = $this->container->get('Doctrine')->getManager();
        /* @var $em \Doctrine\ORM\EntityManager */
        if($dbalias = $em->getRepository('matuckAliasBundle:Alias')->findOneBy(array('alias' => $alias)))
        {
            return $dbalias->getTruepath();
        }
        throw new \Doctrine\ORM\EntityNotFoundException();
    }
    
    /**
     * 
     * @param type $truepath
     * @return type
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getAliasesForTruePath($truepath)
    {
        $em = $this->container->get('Doctrine')->getManager();
        /* @var $em \Doctrine\ORM\EntityManager */
        $aliases = $em->getRepository('matuckAliasBundle:Alias')->findBy(array('truepath' => $truepath));
        if(count($aliases) > 0)
        {
            return $aliases;
        }
        else
        {
            throw new \Doctrine\ORM\EntityNotFoundException();
        }
    }
}

