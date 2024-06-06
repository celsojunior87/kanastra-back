<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    protected $table = 'ticket';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'governmentId',
        'email',
        'debtAmount',
        'debtDueDate',
        'debtId',
    ];

}
