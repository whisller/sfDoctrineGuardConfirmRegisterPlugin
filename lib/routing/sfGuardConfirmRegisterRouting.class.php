<?php
/**
 * Class is adding routing for plugin
 *
 * @package    sfDoctrineGuardConfirmRegisterPlugin
 * @subpackage lib.routing
 * @author     Daniel Ancuta <whisller@gmail.com>
 */
class sfGuardConfirmRegisterRouting
{
    /**
     * Listens to the routing.load_configuration event.
     *
     * @param sfEvent An sfEvent instance
     */
    static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
    {
        $r = $event->getSubject();

        // preprend our routes

        // add route for action to confirm by user
        $r->prependRoute('sf_guard_confirm_register', new sfRoute('/sf_guard_confirm_register/:hash', array('module' => 'sfGuardConfirmRegister',
                                                                                                            'action' => 'Confirm')));
    }
}