<?php
/**
 * RBooking
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    RBooking
 * @subpackage Core
 * @author     Ivica <ivicadevelopermarinkovic@gmail.com>
 * @copyright  2018 Ivica 
 * 
 * 
 */
class WithdrawalEventHandler extends Object implements CakeEventListener
{
    /**
     * implementedEvents
     *
     * @return array
     */
    public function implementedEvents() 
    {
        return array(
            'View.AdminDasboard.onActionToBeTaken' => array(
                'callable' => 'onActionToBeTakenRender'
            )
        );
    }
    public function onActionToBeTakenRender($event) 
    {
        $view = $event->subject();
        App::import('Model', 'Withdrawals.UserCashWithdrawal');
        $UserCashWithdrawal = new UserCashWithdrawal();
        $data = array();
        $data['pending_withdraw_count'] = $UserCashWithdrawal->find('count', array(
            'conditions' => array(
                'UserCashWithdrawal.withdrawal_status_id' => ConstWithdrawalStatus::Pending
            ) ,
            'recursive' => -1
        ));
        $event->data['content']['UserWithdrawRequests'] = $view->element('Withdrawals.admin_action_taken', $data);
    }
}
?>