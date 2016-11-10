<?php

namespace App\Http\Controllers;

use App\Member;
use App\Tithe;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\View;
use Charts;

class ReportController extends Controller
{
    public function __construct()
    {
        if (Auth::check()){

        }else{
            Auth::logout();
            return View::make('login');
        }
    }

    public function index(){
        return View::make('report.index');
    }

    public function totalTithesMember(){
        $obj = new Tithe();
        $data['data'] = $obj->getTithesTotalMember();

        return View::make('report.tithemember', $data);
    }

    public function tithesDetail($id){
        $data['tithes'] = Member::find($id)->tithe()->get();
        $data['member'] = Member::find($id);

        return View::make('report.tithedetail', $data);
    }

    public function tithesPeriod(Request $request){
        if ((!empty($request->initialdate)) && (!empty($request->finaldate))){
            $data['data'] = Tithe::where('period', '>=', $request->initialdate)->where('period', '<=', $request->finaldate)->get();
        }elseif ((!empty($request->initialdate)) || (!empty($request->finaldate))){
            if (!empty($request->initialdate)){
                $data['data'] = Tithe::where('period', '>=', $request->initialdate)->get();
            }else{
                $data['data'] = Tithe::where('period', '<=', $request->finaldate)->get();
            }
        }else{
            $data['data'] = Tithe::all();
        }

        return View::make('report.titheperiod', $data);

    }
    
    public function tithesByMonth(){
        $tithe = new \App\Tithe();
        $report = $tithe->getTithesByMonth();
        
        if(!empty($report)){
            foreach ($report as $r){
                $labels[] = $r->month;
                $values[] = $r->total;

            }
        }else{
            $labels[] = null;
            $values[] = null;
        }
        
        $data['area'] = Charts::create ('area', 'highcharts')
                        ->setTitle(trans('messages.amount_tithes') .' / '. date('Y'))
                        ->setLabels($labels)
                        ->setValues($values)
                        ->setElementLabel(trans('messages.tithe'))
                        ->setResponsive(true);
        
        unset($labels);
        unset($values);
        unset($report);
        
        $report = $tithe->getTithesByTypes();
        
        if(!empty($report)){
             foreach ($report as $r){
                $labels[] = $r->type;
                $values[] = $r->total;

            }
        }else{
            $labels[] = null;
            $values[] = null;
        }
        
        $data['pie'] = Charts::create ('pie', 'highcharts')
                        ->setTitle(trans('messages.tithes_of') . date('F, Y'))
                        ->setLabels($labels)
                        ->setValues($values)
                        ->setElementLabel(trans('messages.months'))
                        ->setResponsive(true);
        
        unset($labels);
        unset($values);
        unset($report);
        
        $report = $tithe->getTithesByMembers();
        
        if(!empty($report)){
            foreach ($report as $r){
               $labels[] = $r->name;
               $values[] = $r->total;
            }
        }else{
            $labels[] = null;
            $values[] = null;
        }
        
        $data['bar'] = Charts::create ('donut', 'highcharts')
                        ->setTitle(trans('messages.amount_tithes_by_member') . date('F, Y'))
                        ->setLabels($labels)
                        ->setValues($values)
                        ->setElementLabel(trans('messages.tithe'))
                        ->setResponsive(true);
        
        unset($labels);
        unset($values);
        unset($report);
        
        $report = $tithe->getTithesByMonth();
        $expenses = new \App\Expense();
        $report1 = $expenses->getExpensesByMonth();
        
        if(!empty($report)){
            foreach ($report as $r){
                $values[] = $r->total;
                $labels[] = $r->month;
            }
        }else{
            $labels1[] = null;
            $values[] = null;
        }
        
        if(!empty($report1)){
            foreach ($report1 as $r1){
                $values1[] = $r1->expenses;
            }
        }else{
            $values1[] = null;
        }
        
        $data['line'] = Charts::multi('bar', 'chartjs')
                        ->setDimensions(0, 500)
                        ->setResponsive(false)
                        ->setTitle(trans('messages.tithes_expenses') . date('Y'))
                        ->setLabels($labels)
                        ->setDataset(trans('messages.tithes'),$values)
                        ->setDataset(trans('messages.expense'),$values1)
                        ->setElementLabel(trans('messages.tithe'));
        
        return View::make('report.tithebymonth', $data);
    }
    
    public function expensesDetails(){
        $expenses = new \App\Expense();
        $data['expenses'] = $expenses->getExpensesPivot();
        
        $data['elements'] = array_count_values(array_column($data['expenses'], 'id'));
        
        return View::make('report.expensesdetails', $data);
    }
    
    public function expenseGraph() {
        $expense = new \App\Expense();
        $report = $expense->getExpenseByMonthGraph();
                
        if(!empty($report)){
            foreach ($report as $r){
                $labels[] = $r->period;
                $values[] = $r->total;

            }
        }else{
            $labels[] = null;
            $values[] = null;
        }
        
        $data['line'] = Charts::create ('area', 'highcharts')
                        ->setTitle(trans('messages.expense') .' / '. date('Y'))
                        ->setLabels($labels)
                        ->setValues($values)
                        ->setElementLabel(trans('messages.expense'))
                        ->setResponsive(true);
        
        unset($labels);
        unset($values);
        unset($report);
        
        
        $report = $expense->getExpenseBySubcategory();
        
        dd(array_pluck($report, 'subcategory'));
        if(!empty($report)){
            foreach ($report as $r){
                $labels[] = $r->subcategory;
                $values[] = $r->total;
                $period[] = $r->period;
            }
        }else{
            $labels[] = null;
            $values[] = null;
        }
        
        $data['bar'] = Charts::multi('line', 'highcharts')
                        ->setTitle(trans('messages.expense') .' / '. date('Y'))
                        ->setLabels($labels)
                        ->setDataset($labels[0],$values)
                        ->setDataset($labels[1],$values)
                        ->setElementLabel(trans('messages.expense'))
                        ->setResponsive(true);
         
        unset($labels);
        unset($values);
        unset($report);
        
        return View::make('report.expensegraph', $data);
    }
            
}
