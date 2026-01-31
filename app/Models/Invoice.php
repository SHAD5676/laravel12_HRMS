<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee; // Ei line-ti miss hoyeche

class Invoice extends Model
{
    protected $fillable = ['employee_id', 'invoice_no', 'amount', 'status'];

  public function employee() 
{
    // Employee model er bodole User model use korun
    return $this->belongsTo(\App\Models\User::class, 'employee_id');
}
}