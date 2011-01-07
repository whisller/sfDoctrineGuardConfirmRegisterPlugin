<?php
/**
 * sfDoctrineGuardConfirmRegisterPlugin configuration.
 *
 * @package    sfDoctrineGuardConfirmRegisterPlugin
 * @subpackage config
 * @author     Daniel Ancuta <whisller@gmail.com>
 */
class sfDoctrineGuardConfirmRegisterPluginConfiguration extends sfPluginConfiguration
{
    /**
     * @see sfPluginConfiguration
     */
    public function initialize()
    {
        if (sfConfig::get('app_sf_guard_confirm_register_plugin_routes_register', true) && in_array('sfGuardConfirmRegister', sfConfig::get('sf_enabled_modules', array()))) {
            $this->dispatcher->connect('routing.load_configuration', array('sfGuardConfirmRegisterRouting', 'listenToRoutingLoadConfigurationEvent'));

            $this->dispatcher->connect('sf_guard_user.register_save_object', array('sfGuardConfirmRegisterExtension', 'listenToUserRegister'));
        }
    }
}