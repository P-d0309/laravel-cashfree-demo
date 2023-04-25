<?php

namespace App\Http\Controllers\Integration\CashFree;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLinkRequest;
use App\Models\CashFreeLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LinkController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$cashFreeLinks = CashFreeLink::orderBy('id', 'desc')->paginate(5);

		return view('integrations.cashfree.index', compact('cashFreeLinks'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('integrations.cashfree.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(CreateLinkRequest $request)
	{
		$apiKey = env('CARDFREE_CLIENT_ID');
		$apiSecret = env('CARDFREE_CLIENT_SECRET');

		$link_id = Str::uuid()->toString();
		$link_amount = $request->link_amount;
		$link_currency = CashFreeLink::LINK_CURRENCY;
		$link_purpose = $request->link_purpose;
		$is_upi = $request->is_upi ? true : false;
		$customer_phone = $request->customer_phone;
		$customer_email = $request->customer_email;
		$link_expiry_time = now()->addDay();
		$send_sms = true;
		$send_email = $request->customer_email ? true : false;
		$link_meta = [
			'link_meta' => route('cfPaymentWebhook', ['link_id' => $link_id]),
		];
		$customer_details = [
			'customer_phone' => $customer_phone,
			'customer_email' => $customer_email,
		];
		$link_notify = [
			'send_sms' => $send_sms,
			'send_email' => $send_email,
		];

		$body = [
			'link_id' => $link_id,
			'link_amount' => $link_amount,
			'link_currency' => $link_currency,
			'link_purpose' => $link_purpose,
			'link_expiry_time' => $link_expiry_time,
			'customer_details' => $customer_details,
			'link_notify' => $link_notify,
			'link_meta' => $link_meta
		];

		$headers = [
			'accept' => 'application/json',
			'content-type' => 'application/json',
			'x-api-version' => CashFreeLink::API_VERSION,
			'x-client-id' => $apiKey,
			'x-client-secret' => $apiSecret,
		];

		try {
			$apiURL = env('CARDFREE_ENV_MODE')  == "production" ? 'https://api.cashfree.com/pg/links' : 'https://sandbox.cashfree.com/pg/links';
			$response = Http::withHeaders($headers)->post($apiURL, $body);

			if ($response->successful()) {
				$data = $response->json();

				$cashFreeLink = new CashFreeLink;
				$cashFreeLink->link_purpose = $link_purpose;
				$cashFreeLink->link_amount = $link_amount;
				$cashFreeLink->link_id = $link_id;
				$cashFreeLink->customer_phone = $customer_phone;
				$cashFreeLink->link_currency = $link_currency;
				$cashFreeLink->customer_email = $customer_email;
				$cashFreeLink->customer_name = $link_purpose;
				$cashFreeLink->is_upi = $is_upi;
				$cashFreeLink->send_sms = $send_sms;
				$cashFreeLink->send_email = $send_email;
				$cashFreeLink->link_status = isset($data['link_status']) ?  $data['link_status']  : null;;
				$cashFreeLink->cf_link_id = isset($data['cf_link_id']) ?  $data['cf_link_id']  : null;
				$cashFreeLink->link_url = isset($data['link_url']) ?  $data['link_url']  : null;
				$cashFreeLink->link_expiry_time = $link_expiry_time;
				$cashFreeLink->created_by = Auth::user()->id;
				$cashFreeLink->save();
				Session::flash('message.level', 'success');
				Session::flash('message.content', 'Link created successfully.');
			}
		} catch (\Throwable $th) {
			Session::flash('message.level', 'error');
			Session::flash('message.content', $th->getMessage());
		}

		return redirect()->route('cashfree-links.index');
	}

	public function updateLinkUsingWebhook(Request $request)
	{
		$data = $request->all();

		try {
		    $data = $data['data'];
			//code...
			$cashFreeLink = CashFreeLink::where('link_id', $data['link_id'])->first();
			$cashFreeLink->link_status = $data['link_status'];
			$cashFreeLink->link_amount_paid = $data['link_amount_paid'];
			$cashFreeLink->order_id = $data['order']['order_id'];
			$cashFreeLink->order_hash = $data['order']['order_hash'];
			$cashFreeLink->order_amount = $data['order']['order_amount'];
			$cashFreeLink->transaction_id = $data['order']['transaction_id'];
			$cashFreeLink->transaction_status = $data['order']['transaction_status'];
			$cashFreeLink->save();
		} catch (\Throwable $th) {
			//throw $th;
		}
	}
}
