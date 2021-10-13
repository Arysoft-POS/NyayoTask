<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Balance;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    // GENERATE MSISDN
    public function makeMSISDN($phonetomsisdn)
    {
        $bal= Balance::Where('availablebalance', '=', 2022 )->first(); if($bal === Null){abort(404);}
        $twochars= substr($phonetomsisdn, 0, 2);
        $threechars= substr($phonetomsisdn, 0, 3);

        if ($twochars === "07") {
            $simu = substr($phonetomsisdn, 1);
            $countrycode = "254";
            $returnedmsisdn = $countrycode.$simu;
        }
        if ($twochars === "01") {
            $simu = substr($phonetomsisdn, 1);
            $countrycode = "254";
            $returnedmsisdn = $countrycode . $simu;
        }
        if ($twochars === "+2") {
            $returnedmsisdn = substr($phonetomsisdn, 1);
        }
    
        if ($threechars === "254") {
            $returnedmsisdn = $phonetomsisdn;
        }
    
        return $returnedmsisdn;
    }
    // END GENERATE MSISDN


    // CODE GENERATOR  
    function getCODE($n) {

        $characters = 'BC970DEFGHI0JKLMNPQRSTUVWXYZ';
         $randomString = '';
          for ($i = 0; $i < $n; $i++)
           {
              $index = rand(0, strlen($characters) - 1);
              $randomString .= $characters[$index];
            } 

          return $randomString;
         } 
      // END CODE GENERATOR
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $bal= Balance::Where('availablebalance', '=', 2022 )->first(); if($bal === Null){abort(404);}

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:10','max:10','unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

   

      /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
        $nameinitials =  strtoupper(substr($data['name'], 0, 3));
        $invitecode = $nameinitials.$this->getCODE(2). Carbon::rawParse('now')->format('ds');

        $bal= Balance::Where('availablebalance', '=', 2022 )->first(); if($bal === Null){abort(404);}

        $msisdn = $this->makeMSISDN($data['phone']);

        return User::create([
            'name' => $data['name'],
            'invitecode' => $invitecode,
            'email' => $data['email'],
            'phone' => $data['phone'],
            'msisdn' => $msisdn,
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function registerinvitecode(Request $request)
    {
        $bal= Balance::Where('availablebalance', '=', 2022 )->first(); if($bal === Null){abort(404);}

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'referral'=>'required',
            'phone' => ['required', 'string', 'min:10','max:10','unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
        $bal= Balance::Where('availablebalance', '=', 2022 )->first(); if($bal === Null){abort(404);}

        $input = $request->all();

        $nameinitials =  strtoupper(substr($input['name'], 0, 3));
        $invitecode = $nameinitials.$this->getCODE(2). Carbon::rawParse('now')->format('ds');
        
        $bal= Balance::Where('availablebalance', '=', 2022 )->first(); if($bal === Null){abort(404);}
        $user = new User();
        $user->name = $input['name'];
        $user->referral = $input['referral'];
        $user->invitecode = $invitecode;
        $user->email = $input['email'];
        $user->phone = $input['phone'];
        $user->msisdn = $this->makeMSISDN($input['phone']);
        $user->password = Hash::make($input['password']);
        $user->save();
        $bal= Balance::Where('availablebalance', '=', 2022 )->first(); if($bal === Null){abort(404);}
        return redirect('login')
                      ->with('success','Now login to the System to proceed...');
}
           
   
}
