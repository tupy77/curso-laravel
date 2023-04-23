<?php

namespace App\Http\Controllers;

use App\Mail\SummaryReport;
use App\Models\ExpenseReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ExpenseReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        //return ExpenseReport::all();
        return view('expenseReport.index', ['expenseReports'=> ExpenseReport::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expenseReport.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'title' => 'required | min:3'
        ]);

        //dd($validData);

        $report = new ExpenseReport();
        $report->title = $validData['title'];
        $report->save();

        return redirect('/expense_reports');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpenseReport $expenseReport)
    {
        //dd($expenseReport);
        //return $expenseReport->title;
        return view('expenseReport.show', ['report'=> $expenseReport]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $report = ExpenseReport::findOrFail($id);
        return view('expenseReport.edit', ['report'=> $report]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $report = ExpenseReport::findOrFail($id);
        $report->title = $request->get('title');
        $report->save();

        //return redirect('/expense_reports/'.$report->id);
        return redirect('/expense_reports');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $report = ExpenseReport::findOrFail($id);
        $report->delete();

        return redirect('/expense_reports');
    }

    public function confirmDelete(string $id)
    {
        $report = ExpenseReport::findOrFail($id);
        return view('expenseReport.confirmDelete', ['report'=> $report]);
    }

    public function confirmSendMail(string $id)
    {
        $report = ExpenseReport::findOrFail($id);
        return view('expenseReport.confirmSendMail', ['report'=> $report]);
    }

    public function SendMail(Request $request, string $id)
    {
        $report = ExpenseReport::findOrFail($id);
        Mail::to($request->get('email'))->send(new SummaryReport(($report)));
        return redirect('/expense_reports/'.$id);
    }
}
