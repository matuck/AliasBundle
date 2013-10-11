<?php

namespace matuck\AliasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function defaultAction($url = '')
    {
        $aliasservice = $this->get('matuck_alias');
        try
        {
            $trueroute = $this->get('router')->match($aliasservice->getTruepath('/' . $url));
            return $this->forward($trueroute['_controller'], $trueroute);
        }
        catch(\Doctrine\ORM\EntityNotFoundException $e)
        {
            throw new NotFoundHttpException(sprintf('The path /%s could not be found', $url));
        }
        catch(\Symfony\Component\Routing\Exception\ResourceNotFoundException $e)
        {
            throw new NotFoundHttpException(sprintf('The path /%s could not be found', $url));
        }
        catch(\Symfony\Component\Routing\Exception\MethodNotAllowedException $e)
        {
            throw new NotFoundHttpException(sprintf('The path /%s could not be found', $url));
        }
    }
    
    public function testredirectAction($param = '')
    {
        return $this->render('matuckAliasBundle:Default:testredirect.html.twig', array('param' => $param));
    }
}
