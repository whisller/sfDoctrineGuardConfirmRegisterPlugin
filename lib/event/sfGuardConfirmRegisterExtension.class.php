<?php
/**
 * Extensions for sfGuard
 *
 * @package    sfDoctrineGuardConfirmRegisterPlugin
 * @subpackage lib.event
 * @author     Daniel Ancuta <whisller@gmail.com>
 */
class sfGuardConfirmRegisterExtension
{
    /**
     * Add new record to sfGuardConfirmRegister after registration is finished
     *
     * @param sfEvent $event
     * @author Daniel Ancuta <whisller@gmail.com>
     */
    public static function listenToUserRegister(sfEvent $event)
    {
        $sfGuardUser = $event->getSubject();

        $sfGuardConfirmRegister = new sfGuardConfirmRegister();
        $sfGuardConfirmRegister->setSfGuardUserId($sfGuardUser->getId());
        $sfGuardConfirmRegister->setHash($sfGuardConfirmRegister->generateHash($sfGuardUser));
        $sfGuardConfirmRegister->save();
    }
}