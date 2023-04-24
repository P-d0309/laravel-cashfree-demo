<?php

namespace App\Http\Controllers\Integration\CashFree;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLinkRequest;
use App\Models\CashFreeLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('integrations.cashfree.index');
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
		$customer_phone = $request->customer_phone;
		$customer_email = $request->customer_email;
		$link_expiry_time = now()->addDay();
		$send_sms = true;
		$send_email = $request->customer_email ? true : false;
		$link_meta = [
			'link_meta' => route('cfPaymentWebhook', ['link_id' => $link_id]),
			// 'return_url' => route('paymentSuccess', ['link_id' => $link_id]),
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

		$apiURL = env('CARDFREE_ENV_MODE')  == "production" ? 'https://api.cashfree.com/pg/links' : 'https://sandbox.cashfree.com/pg/links';
		$response = Http::withHeaders($headers)->post($apiURL, $body)->json();

		return redirect()->back();
	}

	public function updateLinkUsingWebhook(Request $request)
	{
		$data = $request->all();
		\Log::info($data);
	}
}
