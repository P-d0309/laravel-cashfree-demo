<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashFreeLink extends Model
{
	use HasFactory;

	public $fillable = [
		'link_purpose',
		'link_amount',
		'link_id',
		'customer_phone',
		'link_currency',
		'customer_email',
		'customer_name',
		'is_upi',
		'send_sms',
		'send_email',
		'notify_url',
		'return_url',
		'notify_url',
		'link_url',
		'link_status',
		'cf_link_id',
		'link_expiry_time',
		'created_by',
		'link_amount_paid'
	];

	CONST LINK_CURRENCY = "INR";
	const API_VERSION = "2022-09-01";
	public function User() {
		return $this->belongsTo(User::class);
	}
}
