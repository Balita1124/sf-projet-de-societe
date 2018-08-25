<?php
namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('is_active', [$this, 'isActive']),
        ];
    }

    public function isActive($demand, $value)
    {
        if ($demand === $value) {
            return "active";
        }
    }
}