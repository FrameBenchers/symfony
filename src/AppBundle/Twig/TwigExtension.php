<?php

namespace AppBundle\Twig;

use Monolog\Logger;

/**
 * Class TwigExtension.
 */
class TwigExtension extends \Twig_Extension
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('logTemplateEnded', [$this, 'logTemplateEnded']),
        ];
    }

    public function logTemplateEnded($key)
    {
        $this->logger->addInfo(sprintf('request: %d, template ended: %d', $key, microtime(true)*1000));
    }
}
