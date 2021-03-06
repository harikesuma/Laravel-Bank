<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\deposit;
use Carbon\Carbon;

class calculationInterest extends Model
{
    protected $fillable = [
        'transaction_month' , 'transaction_year' , 'calculation_date' , 'master_interest_id' , 'user_id'
    ];

    private $month = [
        'Januari' , 'Februari' , 'Maret' , 'April' , 'Mei' , 'Juni' , 'Juli' , 'Agustus' , 'September' , 'Oktober' , 'November' , 'Desember'
    ];

    public function _GetTotalInterest(){
        $date = Carbon::parse($this->calculation_date)->format('Y-m-d');
        return deposit::where('deposit_type_id',3)->whereDate('date',$date)->sum('nominal_transaction');
    }

    public function _GetMonth(){
        return $this->month[$this->transaction_month - 1];
    }
    /**
     * Relathionship Fungsi
     */

     public function user()
     {
         return $this->belongsTo('App\User');
     }

     public function master_interest()
     {
         return $this->belongsTo('App\masterInterest');
     }
}
