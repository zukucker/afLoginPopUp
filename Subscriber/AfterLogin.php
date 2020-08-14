<?php

namespace afLoginPopUp\Subscriber;

use Enlight\Event\SubscriberInterface;
use Doctrine\Common\Collections\ArrayCollection;

class AfterLogin implements SubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onFrontendPostDispatch',
            'Theme_Compiler_Collect_Plugin_Less' => 'onCollectLess',
        );
    }

    public function onFrontendPostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var $controller \Enlight_Controller_Action */
        $controller = $args->getSubject();
        $view = $controller->View();
        $config = Shopware()->Container()->get('shopware.plugin.cached_config_reader')->getByPluginName('afLoginPopUp');
        $check = Shopware()->Modules()->Admin()->sCheckUser();
        $connection = Shopware()->Container()->get('dbal_connection');
        $plugin = Shopware()->Container()->get('kernel')->getPlugins()['afLoginPopUp'];
        $viewPath = $plugin->getPath() . '/Resources/views/';
        $view->addTemplateDir($viewPath);

        if($check){
            $userData = $view->getAssign('sUserData');
            $user = $userData['additional']['user'];
            $country = $userData['billingaddress']['countryID'];
            $group = $config['afLoginPopUpGroup'];
            $stmnt = "SELECT groupkey FROM `s_core_customergroups` WHERE id = '".$group."'";
            $groupKey = $connection->fetchColumn($stmnt);
            $countryKey = $config['afLoginPopUpCountry'];
            if($groupKey == $user['customergroup'] && $countryKey == $country){
                $view->assign('afLoginPopUp', true);
            }
        }
    }

    public function onCollectLess() {
        $plugin = Shopware()->Container()->get('kernel')->getPlugins()['afLoginPopUp'];
        return new \Shopware\Components\Theme\LessDefinition(
            [],
            [$plugin->getPath() . '/Resources/views/frontend/_public/src/less/all.less'] );
    }
}
