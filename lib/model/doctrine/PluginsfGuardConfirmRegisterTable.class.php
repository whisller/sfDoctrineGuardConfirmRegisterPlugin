<?php
/**
 * PluginsfGuardConfirmRegisterTable
 *
 * @package    sfDoctrineGuardConfirmRegisterPlugin
 * @subpackage model
 * @author     Daniel Ancuta <whisller@gmail.com>
 */
class PluginsfGuardConfirmRegisterTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PluginsfGuardConfirmRegisterTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginsfGuardConfirmRegister');
    }

  /**
   * Retrieves a sfGuardUser object by username, is_active flag and confirmation.
   *
   * @param  String  $username The username
   * @param  Boolean $isActive The user's status
   *
   * @return sfGuardUser
   */
  public static function retrieveByUsername($username, $isActive = true)
  {
    $query = Doctrine_Core::getTable('sfGuardUser')->createQuery('u')
      ->innerJoin('u.ConfirmRegister as cr')
      ->where('u.username = ?',     $username)
      ->addWhere('u.is_active = ?', $isActive)
      ->addWhere('cr.confirm = ?',  true);

    return $query->fetchOne();
  }

    /**
     * Find record by its hash
     *
     * @param  String  $hash
     * @param  Integer $expireAt
     *
     * @return sfGuardConfirmRegister
     *
     * @author Daniel Ancuta <whisller@gmail.com>
     */
    public function findOneActiveByHash($hash, $expireAt = null)
    {
        $query = $this->createQuery('sgcr')
                       ->where('sgcr.hash = ?', array($hash))
                       ->addWhere('sgcr.confirm = ?', false);

        if (null !== $expireAt) {
            $query->addWhere('sgcr.created_at + ? > now()', $expireAt);
        }

        return $query->fetchOne();
    }
}