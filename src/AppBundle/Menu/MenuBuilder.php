<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', array('route' => 'homepage'));
        $menu->addChild('Bets', array('route' => 'betting'));
        $menu->addChild('Subscriptions', array('route' => 'subscriptions'));
        $menu->addChild('Regions', array('route' => 'regions'));
        $menu->addChild('Seasons', array('route' => 'seasons'));
        $menu->addChild('Stages', array('route' => 'stages'));

        return $menu;
    }
}