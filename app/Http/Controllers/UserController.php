<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Validator;


class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getUsers()
    {
        $user = $_GET['id'];
        $current = DB::select("SELECT * FROM users WHERE id = '$user'");
        $not_current = DB::select("SELECT * FROM users WHERE id != '$user'");

        return view('user', [
            'user' => $user,
            'current' => $current,
            'not_current' => $not_current
        ]);
    }



    public function transaction(Request $request)
    {
        if($request->isMethod('post')) {

            $input = $request->except('_token');

            $sum = $request->input('sum');
            $user_from = $request->input('trans_from');
            $user_to = $request->input('trans_to');

            $select_from = DB::select("SELECT * FROM users WHERE id = '$user_from'");
            $select_to = DB::select("SELECT * FROM users WHERE id = '$user_to'");
            $last_transactions = Transaction::where([ ['trans_from',$user_from],['status', 'pending']])->sum('sum');
//            dd($last_transactions);


            $validator = Validator::make($request->all(), [
                'sum' => 'required|numeric|min:1',
                'trans_date' => 'required'

            ]);

            if ($validator->fails()) {
                return redirect('/user?id='.$select_from[0]->id)
                    ->withInput()
                    ->withErrors($validator);
            }

            if ($select_from[0]->balance - $last_transactions - $sum >= 0) {

                $transaction = new Transaction();
                $transaction->fill($input);

                if ($transaction->save()) {
                    return redirect('/')->with('status', 'Транзакция успешно запланирована!');
                }
            } else {
                return redirect('/')->with('status', 'Не хватает денег для перевода!');
            }
        }
    }
}
