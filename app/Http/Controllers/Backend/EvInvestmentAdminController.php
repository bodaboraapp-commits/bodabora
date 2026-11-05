<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\EvInvestment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class EvInvestmentAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = EvInvestment::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('national_id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('stage')) {
            $query->where('stage', $request->stage);
        }

        $investments = $query->orderByDesc('id')->paginate(15);
        $investments->appends($request->all());

        // 4 Key Metrics
        $totalLeads = EvInvestment::count();
        $totalCapital = EvInvestment::sum('total_investment');
        $totalBikes = EvInvestment::sum('bikes_count');
        $convertedCount = EvInvestment::where('stage', 4)->count();
        $conversionRate = $totalLeads > 0 ? round(($convertedCount / $totalLeads) * 100, 1) : 0;

        $metrics = [
            'total_leads' => $totalLeads,
            'total_capital' => $totalCapital,
            'total_bikes' => $totalBikes,
            'conversion_rate' => $conversionRate,
        ];

        return view('backend.ev_investments.index', compact('investments', 'metrics'));
    }

    public function updateStage(Request $request, $id)
    {
        $request->validate([
            'stage' => 'required|integer|min:1|max:5',
        ]);

        $investment = EvInvestment::findOrFail($id);
        $investment->stage = $request->stage;
        if ($request->filled('admin_notes')) {
            $investment->admin_notes = $request->admin_notes;
        }
        $investment->save();

        Toastr::success('Sales journey stage updated successfully.', 'Success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $investment = EvInvestment::findOrFail($id);
        $investment->delete();
        Toastr::success('Investor lead deleted successfully.', 'Success');
        return redirect()->back();
    }
}
