<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $expenses = Expense::where('user_id', '=', $user->id)->latest()->get();
        $categories = Category::latest()->get();
        return Inertia::render('Expense/Index', [
            'expenses' => $expenses,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $categories = Category::latest()->get();
        return Inertia::render('Expense/Create', [
            'categories' => $categories,
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'amount' => ['required'],
            'entry_date' => ['required'],
            'category_id' => ['required'],
        ])->validate();

        $date = Carbon::parse($request->entry_date)->format('Y-m-d H:i:s');
        Expense::create([
            'amount' => $request->amount,
            'entry_date' => $date,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('expense.index');
        // $date = Carbon::parse($request->entry_date)->format('Y-m-d H:i:s');
        // dd($date);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        $id = $expense['id'];
        $expenseRec = Expense::find($id);
        $categories = Category::latest()->get();
        return Inertia::render('Expense/Edit', [
            'expense' => $expenseRec,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'amount' => ['required'],
            'category_id' => ['required'],
            'entry_date' => ['required'],
        ])->validate();

        $date = Carbon::parse($request->entry_date)->format('Y-m-d H:i:s');
        Expense::find($id)->update([
            'amount' => $request->amount,
            'entry_date' => $date,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('expense.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::find($id)->delete();
        return redirect()->route('expense.index');
    }
}
