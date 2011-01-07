<?php
/**
 * Action that allow user to confirm their registration
 *
 * @package    sfDoctrineGuardConfirmRegisterPlugin
 * @subpackage modules.sfGuardConfirmRegister.actions
 * @author     Daniel Ancuta <whisller@gmail.com>
 */
class ConfirmAction extends sfAction
{
    /**
     * @param sfWebRequest $request
     */
    public function execute($request)
    {
        $hash = (string)$request->getParameter('hash');

        $sfGuardConfirmRegister = sfGuardConfirmRegisterTable::getInstance()->findOneActiveByHash($hash, sfConfig::get('app_sf_guard_confirm_register_expire', 604800));

        $this->forward404Unless($sfGuardConfirmRegister instanceof sfGuardConfirmRegister);

        $sfGuardConfirmRegister->setConfirm(true);
        $sfGuardConfirmRegister->save();

        if (sfConfig::get('app_sf_guard_confirm_register_active_user', true)) {
            $sfGuardUser = $sfGuardConfirmRegister->User;
            $sfGuardUser->setIsActive(true);
            $sfGuardUser->save();
        }

        $url = sfConfig::get('app_sf_guard_confirm_register_success_confirm_url', false);
        if ($url) {
            $this->redirect($url);
        }
    }
}