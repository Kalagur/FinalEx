<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $users = DB::select("SELECT
                                  id,
                                  name,
                                  balance,
                                  (SELECT sum
                                   FROM transactions
                                   WHERE transactions.trans_from = users.id
                                   ORDER BY trans_date DESC
                                   LIMIT 1) AS 'transaction_money',
                                   (SELECT trans_date
                                   FROM transactions
                                   WHERE transactions.trans_from = users.id
                                   ORDER BY trans_date DESC
                                   LIMIT 1) AS 'transaction_create',
                                   (SELECT status
                                   FROM transactions
                                   WHERE transactions.trans_from = users.id
                                   ORDER BY trans_date DESC
                                   LIMIT 1) AS 'status'
                                FROM users");

        return view('welcome', [
            'users' => $users,

        ]);
    }
}