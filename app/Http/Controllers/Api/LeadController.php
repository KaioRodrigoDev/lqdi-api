<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::all();

        return response()->json($leads);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $lead = Lead::create($data);

        Mail::send(
            'email.email',
            $data,
            function ($message) use ($data) {
                $message->to($data['email'], 'Admin')->subject($data['message']);
            }
        );

        return $lead;
    }
}
