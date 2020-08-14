<?php

namespace afLoginPopUp;

use Shopware\Components\Plugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Shopware-Plugin afLoginPopUp.
 */
class afLoginPopUp extends Plugin
{

    /**
    * @param ContainerBuilder $container
    */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('af_login_pop_up.plugin_dir', $this->getPath());
        parent::build($container);
    }

}
