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
        }
        
        $data['bar'] = Charts::create ('bar', 'highcharts')
                        ->setTitle(trans('messages.amount_tithes_by_member') . date('F, Y'))
                        ->setLabels($labels)
                        ->setValues($values)
                        ->setElementLabel(trans('messages.tithe'))
                        ->setResponsive(true);
        
        unset($labels);
        unset($values);
        unset($report);
        
        $report = $tithe->getTithesByExpenses();
        
        if(!empty($report)){
            foreach ($report as $r){
                $values1[] = $r->tithes;
                $values2[] = $r->expenses;
                $labels[] = $r->period;
            }
        }
        
        $data['line'] = Charts::multi ('area', 'morris')
                        ->setTitle(trans('messages.tithes_expenses') . date('Y'))
                        ->setLabels($labels)
                        ->setDataset(trans('messages.tithes'),$values1)
                        ->setDataset(trans('messages.expense'),$values2)
                        ->setElementLabel(trans('messages.tithe'))
                        ->setResponsive(true);
        
        return View::make('report.tithebymonth', $data);
    }
}
