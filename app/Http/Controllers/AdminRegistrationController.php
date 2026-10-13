<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationApprovedNotification;
use App\Mail\RegistrationRejectedNotification;
use App\Models\RegistrationApproval;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');

        $registrations = User::whereHas('registrationApproval', function ($query) use ($status) {
            $query->where('status', $status);
        })
        ->with(['registrationApproval', 'profile'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        $stats = [
            'pending' => User::whereHas('registrationApproval', function ($q) {
                $q->where('status', 'pending');
            })->count(),
            'approved' => User::whereHas('registrationApproval', function ($q) {
                $q->where('status', 'approved');
            })->count(),
            'rejected' => User::whereHas('registrationApproval', function ($q) {
                $q->where('status', 'rejected');
            })->count(),
        ];

        return view('admin.registrations.index', compact('registrations', 'status', 'stats'));
    }

    public function show(User $user)
    {
        $user->load(['registrationApproval', 'profile']);

        return view('admin.registrations.show', compact('user'));
    }

    public function approve(Request $request, User $user)
    {

        $approval = $user->registrationApproval;
        if (!$approval || $approval->status !== 'pending') {
            return back()->withErrors('This registration cannot be approved.');
        }

        $approval->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        $user->update([
            'approval_status' => 'approved',
            'approved_at' => now(),
            'approved_by' => auth()->id(),
        ]);

        Mail::to($user->email)->send(new RegistrationApprovedNotification($user));

        return back()->with('success', 'Registration approved. Verification email sent to ' . $user->email);
    }

    public function reject(Request $request, User $user)
    {

        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        $approval = $user->registrationApproval;
        if (!$approval || $approval->status !== 'pending') {
            return back()->withErrors('This registration cannot be rejected.');
        }

        $approval->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'rejection_reason' => $request->reason,
        ]);

        $user->update([
            'approval_status' => 'rejected',
            'approved_at' => now(),
            'approved_by' => auth()->id(),
        ]);

        Mail::to($user->email)->send(new RegistrationRejectedNotification($user, $request->reason));

        return back()->with('success', 'Registration rejected. Notification sent to ' . $user->email);
    }

    public function viewPhotoId(User $user, string $side)
    {

        if ($side === 'front') {
            $path = $user->profile?->photo_id_front_path;
        } else {
            $path = $user->profile?->photo_id_back_path;
        }

        if (!$path || !Storage::disk('private')->exists($path)) {
            abort(404);
        }

        return Storage::disk('private')->download($path);
    }

    public function downloadDocuments(User $user)
    {

        $zip = new \ZipArchive();
        $zipPath = storage_path('app/temp/' . uniqid() . '.zip');

        if (!is_dir(dirname($zipPath))) {
            mkdir(dirname($zipPath), 0755, true);
        }

        if ($zip->open($zipPath, \ZipArchive::CREATE) === true) {
            if ($user->profile?->photo_id_front_path) {
                $frontPath = Storage::disk('private')->path($user->profile->photo_id_front_path);
                $zip->addFile($frontPath, 'photo-id-front.' . pathinfo($frontPath, PATHINFO_EXTENSION));
            }

            if ($user->profile?->photo_id_back_path) {
                $backPath = Storage::disk('private')->path($user->profile->photo_id_back_path);
                $zip->addFile($backPath, 'photo-id-back.' . pathinfo($backPath, PATHINFO_EXTENSION));
            }

            $zip->close();
        }

        return response()->download($zipPath, $user->first_name . '_' . $user->last_name . '_documents.zip')
            ->deleteFileAfterSend(true);
    }
}
