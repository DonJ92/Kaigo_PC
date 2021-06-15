<?php

namespace App\Http\Controllers;


use App\BankAccount;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePwdForm()
    {
        return view('dashboard.changepwd');
    }

    public function changePwd(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'current_password' => 'required',
            'password' => 'required|string|min:6|max:16|confirmed',
            'password_confirmation' => 'required'
        ], [
        ], [
            'current_password' => trans('changepwd.current_password'),
            'password' => trans('changepwd.new_password'),
        ]);

        $user_info = Auth::user();

        if (!Hash::check($data['current_password'], $user_info->password))
        {
            $validator->getMessageBag()->add('current_password', trans('changepwd.invalid_password'));
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        try{
            $user_info->password = Hash::make($data['password']);

            $res = $user_info->save();

            if (!$res)
                return redirect()->back()->withInput()->withErrors(['failed' => trans('changepwd.failed')]);

        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['failed' => trans('changepwd.failed')]);
        }

        return redirect()->route('dashboard.setting.changepwd')->with('success', trans('changepwd.success'));
    }

    public function bankAccountForm()
    {
        $bank_info = BankAccount::where('user_id', Auth::user()->id)->first();
        if (is_null($bank_info))
            $data = array(
                'bank' => '',
                'branch' => '',
                'account_type' => '',
                'account_num' => '',
                'last_name' => '',
                'first_name' => '',
            );
        else
            $data = $bank_info->toArray();

        return view('dashboard.bankaccount', $data);
    }

    public function bankAccount(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'bank' => 'required|string|max:64',
            'branch' => 'required|string|max:64',
            'account_type' => 'required|string|max:64',
            'account_num' => 'required|string|max:64',
            'last_name' => 'required|string|max:32',
            'first_name' => 'required|string|max:32',
        ], [
        ], [
            'bank' => trans('payment.bank_account.bank'),
            'branch' => trans('payment.bank_account.branch'),
            'account_type' => trans('payment.bank_account.account_type'),
            'account_num' => trans('payment.bank_account.account_num'),
            'last_name' => trans('payment.bank_account.last_name'),
            'first_name' => trans('payment.bank_account.first_name'),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        try {
            $bank_info = BankAccount::where('user_id', Auth::user()->id)->first();
            if (is_null($bank_info))
                $res = BankAccount::insert([
                    'user_id' => Auth::user()->id,
                    'bank' => $data['bank'],
                    'branch' => $data['branch'],
                    'account_type' => $data['account_type'],
                    'account_num' => $data['account_num'],
                    'last_name' => $data['last_name'],
                    'first_name' => $data['first_name'],
                ]);
            else {
                $bank_info->bank = $data['bank'];
                $bank_info->branch = $data['branch'];
                $bank_info->account_type = $data['account_type'];
                $bank_info->account_num = $data['account_num'];
                $bank_info->last_name = $data['last_name'];
                $bank_info->first_name = $data['first_name'];
                $bank_info->save();
            }
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['failed' => trans('payment.bank_account.failed')]);
        }

        return redirect()->route('dashboard.setting.bankaccount')->with('success', trans('payment.bank_account.success'));
    }

    public function creditcardForm()
    {
        return view('dashboard.creditcard');
    }

    public function notificationForm()
    {
        return view('dashboard.notification');
    }

    public function contactUsForm()
    {
        return view('dashboard.contactus');
    }

    public function serviceForm()
    {
        return view('dashboard.service');
    }
}