<?php

namespace App\Service;


use App\Models\Notification;
use App\Util\LoggerUtil;
use Illuminate\Support\Facades\Log;

class NotificationService
{

    public function getUserNotifications($userNumber)
    {
        return Notification::where('user_number',$userNumber)->where('status', 'UNREAD') ->orderBy('created_at', 'desc')->take(5)->get();
    }

    /**
     * Generic method to notify any user.
     */
    public static function notifyUser($userNumber, $title, $message, $meta = [])
    {
        try {

            if (!$userNumber) {
                LoggerUtil::warning("User not found for notification: $userNumber");
                return false;
            }

            Notification::create([
                'user_number' => $userNumber,
                'title'       => $title,
                'message'     => $message,
                'meta'        => json_encode($meta),
                'status'      => 'UNREAD',
            ]);

            LoggerUtil::info("Notification sent to user: $userNumber");
            return true;

        } catch (\Exception $e) {
            LoggerUtil::error("Notification sending failed: " . $e->getMessage());
            return false;
        }
    }

    public function getNotificationsByUserNumber($userNumber){

        LoggerUtil::info("getNotificationsByUserNumber: $userNumber");

        return Notification::where('user_number',$userNumber)->orderBy('created_at', 'desc')->get();
    }


    /**
     * Specific: notify driver about new loan
     */
    public static function sendDriverLoanNotification($driverNumber, $loan){

        LoggerUtil::info("Sending notification to driver: $driverNumber and Loan :$loan");

        $title = "New Loan Assigned";
        $message = "A new loan (" . $loan->loan_number . ") has been assigned to you.";

        return self::notifyUser($driverNumber, $title, $message, [
            'loan_id'     => $loan->loan_number,
            'vehicle_id'  => $loan->vehicle_id,
            'amount'      => $loan->final_loan_amount
        ]);
    }



    public static function sendOwnerRegistrationNotification($firstName, $email, $phone, $managerUserNumber)
    {
        LoggerUtil::info("Sending registration notification to Vehicle Owner: $firstName");

        $title = "Registration Successful";
        $message = "Successfully registered the vehicle owner   $firstName! .";

        return self::notifyUser($managerUserNumber, $title, $message, [
            'first_name' => $firstName,
            'email'      => $email,
            'phone'      => $phone,
        ]);
    }

}
