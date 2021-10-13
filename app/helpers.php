<?php

use App\Models\Product;
use App\Models\Counterallocator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\AcountIn;
use App\Models\AcountOut;
use App\Models\Subject;
use App\Models\Bonus;
use Carbon\Carbon;

    function getUserLevel()
    {
       
     $uLevel = User::where('phone','=', Auth::user()->phone )->value('level');
      return $uLevel;

    }

  

    function getUserBalance()
    {
       
        $balance = 0;
        $msisdn = Auth::user()->msisdn;

        $accountin = AcountIn::Where('msisdn', '=', $msisdn )
                                    ->Where('activation','=',"No")
                                    ->sum('Txsum');

        $accountout = AcountOut::Where('msisdn', '=', $msisdn )
                                ->Where('activation','=',"No")
                                ->sum('Txsum');
                                
        $balance =  $accountin - $accountout;
        return $balance;
    }


        // REFERRAL

    function getCurrentReferralUserBonus()
    {

        $currentreferralbonus = 0;
        $msisdn = Auth::user()->msisdn;
        $referralbonusin = Bonus::Where('beneficiarymsisdn', '=', $msisdn )
                        ->where('bonustype','=', 'referral')
                        ->where('txtype','=', 'd')
                        ->sum('amounttobeneficiary');

        $referralbonusout = Bonus::Where('beneficiarymsisdn', '=', $msisdn )
                        ->where('bonustype','=', 'referral')
                        ->where('txtype','=', 'w')
                        ->sum('excess');

        $currentreferralbonus = $referralbonusin - $referralbonusout;
       
        return $currentreferralbonus;
    }

    function getTotalReferralUserBonus()
    {

        $totalreferralbonus = 0;
        $msisdn = Auth::user()->msisdn;
        $totalreferralbonus = Bonus::Where('beneficiarymsisdn', '=', $msisdn )
                        ->where('bonustype','=', 'referral')
                        ->where('txtype','=', 'd')
                        ->sum('amounttobeneficiary');
       
        return $totalreferralbonus;
    }


    // END REFERRAL

    // USER BONUS
    function getTotalUserBonus()
    {

        $bonus = 0;
        $msisdn = Auth::user()->msisdn;
        $bonus = Bonus::Where('beneficiarymsisdn', '=', $msisdn )
                                    ->where('txtype','=', 'd')
                                    ->sum('amounttobeneficiary');
       
        return $bonus;
    }
    // END USER BONUS


    // INVESTMENT BONUS

    function getCurrentInvestmentUserBonus()
    {

        $currentinvestmentbonus = 0;

        $msisdn = Auth::user()->msisdn;

        $investmentbonusin  = Bonus::Where('beneficiarymsisdn', '=', $msisdn )
                        ->where('bonustype','=', 'investment')
                        ->where('active','=',"Inactive")
                        ->where('status','=',"Paid")
                        ->where('txtype','=', 'd')
                        ->sum('amounttobeneficiary');

        $investmentbonusout = Bonus::Where('beneficiarymsisdn', '=', $msisdn )
                        ->where('bonustype','=', 'investment')
                        ->where('details','=',"Widthdrawal")
                        ->where('txtype','=', 'w')
                        ->sum('excess');

        $currentinvestmentbonus = $investmentbonusin - $investmentbonusout;
       
        return $currentinvestmentbonus;
    }

    function getTotalInvestmentUserBonus()
    {

        $totalinvestmentbonus= 0;
        $msisdn = Auth::user()->msisdn;

        $totalinvestmentbonus = Bonus::Where('beneficiarymsisdn', '=', $msisdn )
                        ->where('bonustype','=', 'investment')
                        ->where('txtype','=', 'd')
                        ->where('active','=',"Inactive")
                        ->where('status','=',"Paid")
                        ->sum('amounttobeneficiary');
       
        return $totalinvestmentbonus;
    }

    // END INVESTMENT BONUS



    // TRANSACTIONS SUM
    function getTotalUserTx()
    {

        $totaltx = 0;
        $msisdn = Auth::user()->msisdn;

        $totalinvestmentbonus = Bonus::Where('beneficiarymsisdn', '=', $msisdn )
                        ->where('bonustype','=', 'investment')
                        ->where('txtype','=', 'd')
                        ->sum('amounttobeneficiary');

        $accountin = AcountIn::Where('msisdn', '=', $msisdn )
                        ->sum('Txsum');

        $accountout = AcountOut::Where('msisdn', '=', $msisdn )
                        ->sum('Txsum');

        $totaltx = $accountin + $accountout + $totalinvestmentbonus ;

        return $totaltx;
    }
    // END TRANSACTIONS SUM



    // TOTAL USER REFERRALS
    function getTotalUserReferrals()
    {
        $gettotalreferrals = User::where('referral','=', Auth::user()->invitecode )->get('phone');

        $totalreferrals = $gettotalreferrals->count();

        return $totalreferrals ;
    }
    // END TOTAL USER REFERRALS

    // USER REFERRALS THAT NEVER ACTIVATED
    function getTotalUserReferralsNeverActivated()
    {
        $getreferralsNeverActivated = User::where('referral','=', Auth::user()->invitecode )->Where('registered','=',"No")->get('phone');

        $referralsNeverActivated = $getreferralsNeverActivated->count();

        return $referralsNeverActivated;
    }
    // END  USER REFERRALS THAT NEVER ACTIVATED

// WINDOW CHECKER
function windowchecker()
{
    $timezone = 'Africa/Nairobi';

    $startlastwindow = Carbon::parse('today 1:50am',$timezone);
    $endlastwindow = Carbon::parse('today 11:59pm',$timezone);
 
    $startfirstwindow = Carbon::parse('today 6:00am',$timezone);
    $endfirstwindow = Carbon::parse('today 6:01am',$timezone);
 
    $startsecondwindow = Carbon::parse('today 10:00am',$timezone);
    $endsecondwindow = Carbon::parse('today 10:01am',$timezone);
 
    $startthirdwindow = Carbon::parse('today 2:00pm',$timezone);
    $endthirdwindow = Carbon::parse('today 2:01pm',$timezone);
 
    $startfourthwindow = Carbon::parse('today 6:00pm',$timezone);
    $endfourthwindow = Carbon::parse('today 6:01pm',$timezone);
 
    $startfifthwindow = Carbon::parse('today 10:00pm',$timezone);
    $endfifthwindow = Carbon::parse('today 10:01pm',$timezone);

    $now = Carbon::now($timezone);

    if (
    
    ( $now->gte($startfirstwindow) && $now->lte($endfirstwindow) ) ||
    ( $now->gte($startsecondwindow) && $now->lte($endsecondwindow) ) ||
    ( $now->gte($startthirdwindow) && $now->lte($endthirdwindow) ) ||
    ( $now->gte($startfourthwindow) && $now->lte($endfourthwindow) ) ||
    ( $now->gte($startfifthwindow) && $now->lte($endfifthwindow) ) ||
    ( $now->gte($startlastwindow) && $now->lte($endlastwindow) ) 
    
    )
    {
        $windowchecker = "Yes";
     }else
    {
        $windowchecker = "No";  
    }
    return $windowchecker;
}
// END WINDOW CHECKER

    // REFERRALS WITH RUNNING INVESTMENTS
    function getUserReferralsWithRunningInvestments()
    {
        $countRunning = array();

       $Activatedreferrals = User::Where('registered','=',"Yes")->where('referral','=', Auth::user()->invitecode )->pluck('msisdn');

        foreach( $Activatedreferrals as  $Activatedreferral )
        {
            $hasrunning = Subject::where('msisdn','=', $Activatedreferral )->where('active','=',"Active")->value('amount');

            //validate "running" and add to count

            if($hasrunning > 50 )
            {
               array_push($countRunning, $Activatedreferrals);
            }
        }

        $referralsWithRunningInvestments = count($countRunning);

        return $referralsWithRunningInvestments;
    }
    // END REFERRALS WITH RUNNING INVESTMENTS

    // REFERRALS WHO INVESTED
    function getUserReferralsWhoInvested()
    {
        $countRunning = array();
        
        $Activatedreferrals = User::Where('registered','=',"Yes")->where('referral','=', Auth::user()->invitecode )->pluck('msisdn');

        foreach( $Activatedreferrals as  $Activatedreferral )
        {
            $hasrunning = Subject::where('msisdn','=', $Activatedreferral )->value('amount');

            //validate "running" and add to count

            if($hasrunning > 50 )
            {
               array_push($countRunning,$hasrunning);
            }
        }

        $userReferralsWhoInvested = count($countRunning);

        return $userReferralsWhoInvested;
    }
    // END REFERRALS WHO INVESTED

    function completeInvestment()
{

       // MAKE MATURITY CODE
    $checksubjectsformaturity = Subject::Where('type', '=', 'Investment')->Where('active', '=', 'Active')->orWhere('status', '=', 'Running')->get();
    
    $timenow =  Carbon::now();

    foreach ($checksubjectsformaturity as $checksubject) {
        $now =  strtotime($timenow);
        $matureat = strtotime($checksubject->shift);
        if ($matureat >= $now) {
        } else {
            Subject::where('code', '=', $checksubject->code)->update(['status' => "Ready" ]);
            Bonus::where('code', '=', $checksubject->code)->update(['status' => "Paid" ]);
            Bonus::where('code', '=', $checksubject->code)->update(['active' => "Inactive" ]);
            Bonus::where('code', '=', $checksubject->code)->update(['status' => "Paid" ]);
        }
    }
    // END MAKE MATURITY CODE
    return true;
}

function getUserHasRunningInvestment()
{

    $checkuserhasinvestment = Subject::Where('tablenumber','=',Auth::user()->phone )->where('msisdn','=',Auth::user()->msisdn )->where('type', '=', 'Investment')->Where('active', '=', 'Active')->orWhere('status', '=', 'Running')->first();
     
    if( $checkuserhasinvestment )
    {
        return true;
    }
    else
    {
        return false;
    }
}

function getfriends()
{

    $friends = User::where('referral','=', Auth::user()->invitecode )->get();
    
        return $friends;
   
}


    // GET CAHRGES
    function getTxCharges($cash)
    {
        $tax=0;

      $tax = 0.005*$cash;

        return $tax;
    }
    // GET CHARGES


// ADMIN USE

     // cash Now
     function cashNow()
     {

        $accountin = AcountIn::sum('Txsum');

        $accountout = AcountOut::sum('Txsum');
                                
        $balance =  $accountin - $accountout;

        return $balance;
     }
     // end cash now

     // payout Today
     function payoutToday()
     {
        $today = Carbon::today();

        $referralbonusin = Bonus::WhereDate('readyby','=', $today )
                                 ->sum('amounttobeneficiary');

        $referralbonusout = Subject::WhereDate('shift','=', $today )
                            ->sum('Txsum');

         $balance =  $referralbonusin + $referralbonusout;

                            return $balance;

     }
     // end payout Today

      // payout Tomorrow
      function payoutTommorow()
      {
         $tomorrow = Carbon::tomorrow();
 
         $referralbonusin = Bonus::WhereDate('readyby','=', $tomorrow )
                                  ->sum('amounttobeneficiary');
 
         $referralbonusout = Subject::WhereDate('shift','=', $tomorrow )
                             ->sum('Txsum');
 
          $balance =  $referralbonusin + $referralbonusout;
 
                             return $balance;
 
      }
      // end payout Tomorrow

      function withdrawnToday()
      {
        $today = Carbon::today();
 
         $accountout = AcountOut::Where('Txtype','=',"Withdrawal")->WhereDate('TransTime','=', $today )->sum('TransAmount');
 
         return $accountout;
      }
  
     function withdrawnYesterday()
     {
        $yesterday = Carbon::yesterday();
 
        $accountout = AcountOut::Where('Txtype','=',"Withdrawal")->WhereDate('TransTime','=', $yesterday )->sum('TransAmount');

        return $accountout;
     }
     // end payout Today

      // deposits Today
      function depositsToday()
      {
 
        $today = Carbon::today();
        $accountout = AcountIn::Where('Txtype','=',"Deposit")->WhereDate('TransTime','=', $today )->sum('Txsum');

        return $accountout;
      }
      // end depo Today


       // withd Today
       function depositsYesterday()
       {
  
        $yesterday = Carbon::yesterday();
 
        $accountout = AcountIn::Where('Txtype','=',"Deposit")->WhereDate('TransTime','=', $yesterday )->sum('Txsum');

        return $accountout;
       }
       // end depo Today

