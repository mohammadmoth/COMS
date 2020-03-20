<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
class AuthExtend extends Auth
{
    public static function isAdmin()
    {
          if (   Auth::rules() == "admin")
          return true;
          return false;
    }
    public static function isEditor()
    {
          if (   Auth::rules() == "editor")
          return true;
          return false;
    }

    public static function isMonitor()
    {
          if (   Auth::rules() == "monitor")
          return true;
          return false;
    }
    

    public static function ChekRulesby($rulesString)
    {
        $numberRulesInt = 0 ;
        switch ($rulesString) {
            case 'admin':
            $numberRulesInt = 0;
                break;
            case 'editor':
            $numberRulesInt = 1;
            break;
            case 'monitor':
            $numberRulesInt = 2;
            break;
        }
        $numberRulesUserInt = 0 ;
        switch (Auth::rules()) {
            case 'admin':
            $numberRulesUserInt = 0;
                break;
            case 'editor':
            $numberRulesUserInt = 1;
            break;
            case 'monitor':
            $numberRulesUserInt = 2;
            break;
        }
        if ( $numberRulesUserInt <= $numberRulesInt)
          return true;


          return false; 
    }


}
