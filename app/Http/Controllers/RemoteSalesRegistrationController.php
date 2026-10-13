<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class RemoteSalesRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.remote-sales-registration');
    }

    public function submitStep1(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other,Prefer not to say',
            'job_title' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $request->session()->put('registration_data', [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'job_title' => $validated['job_title'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'password' => $validated['password'],
        ]);

        return response()->json(['success' => true]);
    }

    public function submitStep2(Request $request)
    {
        $request->validate([
            'photo_id_front' => 'required|file|mimes:png,jpeg,pdf|max:10240',
            'photo_id_back' => 'required|file|mimes:png,jpeg,pdf|max:10240',
        ]);

        $registrationData = $request->session()->get('registration_data', []);

        $frontPath = $request->file('photo_id_front')->store('photo-ids/front', 'private');
        $backPath = $request->file('photo_id_back')->store('photo-ids/back', 'private');

        $registrationData['photo_id_front_path'] = $frontPath;
        $registrationData['photo_id_back_path'] = $backPath;

        $request->session()->put('registration_data', $registrationData);

        return response()->json(['success' => true]);
    }

    public function submitStep3(Request $request)
    {
        $request->validate([
            'terms_accepted' => 'required|accepted',
            'signature' => 'required|string',
        ]);

        $registrationData = $request->session()->get('registration_data', []);

        if (!$registrationData) {
            return response()->json(['error' => 'Session expired. Please start over.'], 400);
        }

        $signatureData = $request->input('signature');

        $signaturePath = null;
        if (strpos($signatureData, 'data:image') === 0) {
            $image = str_replace('data:image/png;base64,', '', $signatureData);
            $image = str_replace(' ', '+', $image);
            $filename = 'signatures/' . uniqid() . '.png';
            Storage::disk('private')->put($filename, base64_decode($image));
            $signaturePath = $filename;
        }

        $registrationData['signature_path'] = $signaturePath;
        $registrationData['terms_accepted_at'] = now();

        $user = User::create([
            'first_name' => $registrationData['first_name'],
            'last_name' => $registrationData['last_name'],
            'email' => $registrationData['email'],
            'password' => Hash::make($registrationData['password']),
            'phone' => $registrationData['phone'],
            'address' => $registrationData['address'],
            'birth_date' => $registrationData['date_of_birth'],
            'gender' => $registrationData['gender'],
            'job_title' => $registrationData['job_title'],
            'approval_status' => 'pending',
            'is_active' => false,
        ]);

        if ($signaturePath || $registrationData['photo_id_front_path'] || $registrationData['photo_id_back_path']) {
            $user->profile()->create([
                'date_of_birth' => $registrationData['date_of_birth'],
                'gender' => $registrationData['gender'],
                'job_title' => $registrationData['job_title'],
                'phone' => $registrationData['phone'],
                'address' => $registrationData['address'],
                'photo_id_front_path' => $registrationData['photo_id_front_path'] ?? null,
                'photo_id_back_path' => $registrationData['photo_id_back_path'] ?? null,
                'signature_path' => $signaturePath,
                'terms_accepted_at' => $registrationData['terms_accepted_at'],
                'terms_version' => '1.0',
            ]);
        }

        $request->session()->forget('registration_data');

        return response()->json([
            'success' => true,
            'message' => 'Registration submitted successfully. Please check your email to verify your account.'
        ]);
    }
}
