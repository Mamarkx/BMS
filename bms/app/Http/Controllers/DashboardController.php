<?php

namespace App\Http\Controllers;

use App\Models\Cedula;
use App\Models\FormID;
use App\Models\Resident;
use App\Models\GeneralForm;
use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use App\Models\BusinessPermit;

class DashboardController extends Controller
{
    public function ShowDashboard()
    {
        $totalUsers = Resident::count();
        $totalEmpoyees = EmployeeModel::count();

        $pendingBusinessPermit = BusinessPermit::where('status', 'Pending')->count();
        $pendingCedula = Cedula::where('status', 'Pending')->count();
        $pendingFormID = FormID::where('status', 'Pending')->count();
        $pendingGeneralForm = GeneralForm::where('status', 'Pending')->count();

        $totalPending = $pendingBusinessPermit + $pendingCedula + $pendingFormID + $pendingGeneralForm;

        $doneBusinessPermit = BusinessPermit::where('status', 'Approved')->count();
        $doneCedula = Cedula::where('status', 'Approved')->count();
        $doneFormID = FormID::where('status', 'Approved')->count();
        $doneGeneralForm = GeneralForm::where('status', 'Approved')->count();

        $totalCertificate = $doneBusinessPermit + $doneCedula + $doneFormID + $doneGeneralForm;

        $maleEmployees = EmployeeModel::where('gender', 'Male')->count();
        $femaleEmployees = EmployeeModel::where('gender', 'Female')->count();
        $otherEmployees = EmployeeModel::whereNotIn('gender', ['Male', 'Female'])->count();

        $monthlyData = Resident::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $fullData = array_fill(1, 12, 0);
        foreach ($monthlyData as $month => $count) {
            $fullData[$month] = $count;
        }
        $residentsPerMonth = array_values($fullData);

        return view('AdminSide.Admin', compact(
            'totalUsers',
            'totalEmpoyees',
            'totalPending',
            'totalCertificate',
            'residentsPerMonth',
            'maleEmployees',
            'femaleEmployees',
            'otherEmployees'
        ));
    }
}
