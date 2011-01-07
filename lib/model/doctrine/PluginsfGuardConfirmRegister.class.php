<?php
/**
 * PluginsfGuardConfirmRegister
 *
 * @package    sfDoctrineGuardConfirmRegisterPlugin
 * @subpackage model
 * @author     Daniel Ancuta <whisller@gmail.com>
 */
abstract class PluginsfGuardConfirmRegister extends BasesfGuardConfirmRegister
{
    /**
     * Generate new hash for the user
     *
     * @param sfGuardUser $sfGuardUser Object of user for which we are generting new hash
     * @author Daniel Ancuta <whisller@gmail.com>
     */
    public function generateHash(sfGuardUser $sfGuardUser)
    {
        return sha1(md5($sfGuardUser->getId().$sfGuardUser->getUsername().$sfGuardUser->getCreatedAt()));
    }
}