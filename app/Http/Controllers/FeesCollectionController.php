<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\SchoolYear;
use App\Models\StudentAddFeesModel;
use App\Models\StudentModel;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class FeesCollectionController extends Controller
{
    public function feesCollection(Request $request)
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        if($progressYear == "0")
        {
            $data['getClass'] = ClassModel::getProgressYearClass();
            if(!empty($request->all()))
            {
                $data['getRecord'] = StudentModel::getProgressYearStudentFees($activeYear);
            }
        }else{
            $data['getClass'] = ClassModel::getClass($activeYear);
            if(!empty($request->all()))
            {
                $data['getRecord'] = StudentModel::getStudentFees($activeYear);
            }
        }
        $data['header_title'] = "Frais|Scolarité";
        return view('admin.fees_collection.collect', $data);
    }

    public function feesCollectionAdd($student_id)
    {  
        $activeYear = SchoolYear::getActiveYear()->id; 
        $data['getFees'] = StudentAddFeesModel::getFees($student_id,$activeYear);
        $getStudent = StudentModel::getSingleClass($student_id,$activeYear);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = "Frais|Scolarité";
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
        return view('admin.fees_collection.add_collect', $data);
    }

    public function feesCollectionInsert($student_id, Request $request)
    {      
        $activeYear = SchoolYear::getActiveYear()->id;
        $getStudent = StudentModel::getSingleClass($student_id,$activeYear); 
        $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);

        if(!empty($request->amount))
        {
            $remainingAmount = $getStudent->amount - $paid_amount;
        if($remainingAmount >= $request->amount)
        {
            $activeYear = SchoolYear::getActiveYear()->id;
            $remainingAmountUser = $remainingAmount - $request->amount;
            $pay = new StudentAddFeesModel;
            $pay->school_year_id = $activeYear;
            $pay->student_id = $student_id;
            $pay->class_id = $getStudent->class_id;
            $pay->paid_amount = $request->amount;
            $pay->total_amount = $remainingAmount;
            $pay->remaining_amount = $remainingAmountUser;
            $pay->payment_type = $request->payment_type;
            $pay->remark = $request->remark;
            $pay->created_by = Auth::user()->id;
            $pay->save();
        return redirect()->back()->with('success',"Opération réussie");
        }
        else
        {
           return redirect()->back()->with('error',"Montant supérieur au montant restant"); 
        }
        }
        else
        {
            return redirect()->back()->with('error',"Vous devez entrer minimum 1 F CFA "); 
        }
    }

    public function feesCollectionReport()
    {
        $activeYear = SchoolYear::getActiveYear()->id;
        $progressYear = SchoolYear::getActiveYear()->inProgress;
        if($progressYear == "0")
        {
            $data['getClass'] = ClassModel::getProgressYearClass();
            $data['getRecord'] = StudentAddFeesModel::getProgressYearRecord();
        }
        else
        {
            $data['getClass'] = ClassModel::getClass($activeYear);
            $data['getRecord'] = StudentAddFeesModel::getRecord($activeYear);
        }
        $data['header_title'] = "Liste|Frais-Scolarité";
        return view('admin.fees_collection.collect_report', $data);
    }
}
