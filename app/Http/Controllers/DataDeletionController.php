<?php

namespace App\Http\Controllers;

use App\DataDeletionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class DataDeletionController extends Controller
{
    /**
     * Show the data deletion request form
     */
    public function index()
    {
        return view('data-deletion.index');
    }

    /**
     * Store a new deletion request
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'user_type' => 'required|in:app_user,shop_owner,employee,other',
            'reason' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $deletionRequest = DataDeletionRequest::create($request->all());

        // Send confirmation email to user
        try {
            Mail::send('emails.deletion-request-confirmation', ['request' => $deletionRequest], function ($message) use ($deletionRequest) {
                $message->to($deletionRequest->email, $deletionRequest->name)
                    ->subject('Data Deletion Request Received - ' . config('app.name'));
            });
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Log::error('Failed to send deletion request confirmation email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Your data deletion request has been submitted successfully. We will process it within 30 days and contact you via email.');
    }

    /**
     * Show thank you page after submission
     */
    public function thankYou()
    {
        return view('data-deletion.thank-you');
    }
}
