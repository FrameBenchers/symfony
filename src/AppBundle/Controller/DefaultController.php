<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->findAll();

        return $this->render('index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/post/{id}", name="post")
     */
    public function showAction($id)
    {
        $key = microtime(true)*1000;

        $logger = $this->get('monolog.logger.benchmark');

        $logger->addInfo(sprintf('request: %d, object started: %d', $key, microtime(true)*1000));
        $post = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->find($id);
        $logger->addInfo(sprintf('request: %d, object ended: %d', $key, microtime(true)*1000));

        $logger->addInfo(sprintf('request: %d, template started: %d', $key, microtime(true)*1000));
        return $this->render('entity.html.twig', [
            'post' => $post,
            'key' => $key,
        ]);
    }
}
