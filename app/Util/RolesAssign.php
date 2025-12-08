<?php

namespace App\Util;

class RolesAssign
{
    // Constants for tracking percentage values
    public const  MANAGER= 'Manager';
    public const  HELPDESK= 'HelpDesk';


    /**
     * Get all tracking percentages.
     *
     * @return array
     */
    public static function getRolesAssign(): array
    {
        return [
            self::MANAGER,
            self::HELPDESK,

        ];
    }
}
