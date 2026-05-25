<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rsvp;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $rsvps = Rsvp::latest()->get();

        if ($request->query('export') === 'csv') {
            return $this->exportCsv($rsvps);
        }

        $stats = [
            'responses'  => $rsvps->count(),
            'attending'  => $rsvps->where('attending', true)->count(),
            'declined'   => $rsvps->where('attending', false)->count(),
            'head_count' => $rsvps->where('attending', true)->sum('number_of_guests'),
        ];

        return view('admin.dashboard', compact('rsvps', 'stats'));
    }

    private function exportCsv($rsvps): StreamedResponse
    {
        $filename = 'rsvps-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($rsvps) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Name', 'Email', 'Attending', 'Guests', 'Meal', 'Dietary', 'Submitted']);

            foreach ($rsvps as $rsvp) {
                fputcsv($out, [
                    $rsvp->name,
                    $rsvp->email,
                    $rsvp->attending ? 'Yes' : 'No',
                    $rsvp->attending ? $rsvp->number_of_guests : 0,
                    $rsvp->meal_choice,
                    $rsvp->dietary_restrictions,
                    $rsvp->created_at->format('Y-m-d H:i'),
                ]);
            }

            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv']);
    }
}
