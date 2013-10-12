<?php

namespace matuck\AliasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function defaultAction($url = '')
    {
        $logger = $this->get('logger');
        /* @var $logger \Monolog\Logger */
        $aliasservice = $this->get('matuck_alias');
        try
        {
            $truepath = $aliasservice->getTruepath('/' . $url);
            $trueroute = $this->get('router')->match($truepath);
            $logger->info(sprintf('Forward %s to %s', '/'.$url, $truepath));
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
