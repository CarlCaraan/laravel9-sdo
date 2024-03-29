<?php

namespace App\Http\Controllers\Admin\ServiceRecord;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRecordRequest;
use Illuminate\Http\Request;
use App\Models\UserRequestServiceRecord;
use App\Models\ServiceRecord;
use App\Models\User;
use App\Mail\CreateSRMail;
use Illuminate\Support\Facades\Mail;
use App\Models\AdminNotification;
use Auth;
use PDF;

class ServiceRecordController extends Controller
{
    public function AllRequestView()
    {
        $data['allData'] = UserRequestServiceRecord::with(['user'])->where('service_record_status', 'Pending')->where('archived', 'No')->orderBy('created_at', 'DESC')->get();
        return view('admin.service_record.view_service_record', $data);
    } // End Method

    public function EditRequestSR($id)
    {
        $data['editData'] = UserRequestServiceRecord::with(['user'])->find($id);
        return view('admin.service_record.edit_service_record', $data);
    }

    public function UpdateRequestSR(Request $request)
    {
        //  ========= All Validation =========
        if ($request->sr_middle_name == '' || $request->sr_dob == '' || $request->sr_pob == '') {
            $notification = array(
                'message' => 'Required field must not be empty!',
                'alert-type' => 'error',
            );
            return redirect()->route('all.request.view')->with($notification);
        }

        $request_id = $request->id;

        // Working With Request Table
        UserRequestServiceRecord::where('id', $request_id)->update([
            'sr_middle_name' => $request->sr_middle_name,
            'sr_dob' => $request->sr_dob,
            'sr_pob' => $request->sr_pob,
        ]);

        // Working With Service Record Table
        ServiceRecord::where('service_request_record_id', $request_id)->delete();

        $count_sr_from = count($request->sr_from);
        for ($i = 0; $i < $count_sr_from; $i++) {
            $service_record = new ServiceRecord();
            $service_record->service_request_record_id = $request_id;
            $service_record->sr_from = $request->sr_from[$i];
            $service_record->sr_to = $request->sr_to[$i];
            $service_record->sr_designation = $request->sr_designation[$i];
            $service_record->sr_status = $request->sr_status[$i];
            $service_record->sr_salary = $request->sr_salary[$i];
            $service_record->sr_place_of_assignment = $request->sr_place_of_assignment[$i];
            $service_record->sr_branch = $request->sr_branch[$i];
            $service_record->sr_separation_date_caused = $request->sr_separation_date_caused[$i];
            $service_record->save();
        } // End For

        UserRequestServiceRecord::find($request_id)->update([
            'service_record_status' => 'Completed'
        ]);

        // Insert Notification for Admin/HR
        $bell =  AdminNotification::where('sr_id', $request_id)->update([
            'status' => 'resolved',
        ]);

        // ========= Start Working with Email =========
        $user = UserRequestServiceRecord::with(['user'])->find($request_id)->first();
        $data = [
            'name' => $user['user']['first_name'] . " " . $user['user']['last_name'],
            'email' => $user['user']['email'],
            'title' => "Service Record Created",
            'message' => "Update! Your Service Record has been created to your account",
        ];
        Mail::to("bannedefused@gmail.com")->send(new CreateSRMail($data)); //  Sends Email
        // ========= End Working with Email =========

        $notification = array(
            'message' => 'Service Record created successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('all.request.view')->with($notification);
    } // End Method

    public function AllCompletedView()
    {
        $data['allData'] = UserRequestServiceRecord::with(['user'])->where('service_record_status', 'Completed')->where('archived', 'No')->orderBy('updated_at', 'DESC')->get();
        return view('admin.service_record.view_completedservice_record', $data);
    } // End Method

    public function ViewDetailsCompletedSR($email, $id)
    {
        $data['allData'] = ServiceRecord::where('service_request_record_id', $id)->orderBy('updated_at', 'DESC')->get();
        $data['allRequest'] = UserRequestServiceRecord::where('id', $id)->get();
        $data['user'] = User::where('email', $email)->first();

        return view('admin.service_record.view_details_completed_sr', $data);
    } // End Method

    public function StoreDetailsCompletedSR(ServiceRecordRequest $request)
    {
        $id = $request->id;
        ServiceRecord::create([
            'service_request_record_id' => $id,
            'sr_from' => $request->sr_from,
            'sr_to' => $request->sr_to,
            'sr_designation' => $request->sr_designation,
            'sr_status' => $request->sr_status,
            'sr_salary' => $request->sr_salary,
            'sr_place_of_assignment' => $request->sr_place_of_assignment,
            'sr_branch' => $request->sr_branch,
            'sr_separation_date_caused' => $request->sr_separation_date_caused,
        ]);

        $notification = array(
            'message' => 'Service Record inserted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } // End Method

    public function UpdateDetailsCompletedSR($id, ServiceRecordRequest $request)
    {
        // Updating Service Record Table
        ServiceRecord::where('id', $id)->update([
            'sr_from' => $request->sr_from,
            'sr_to' => $request->sr_to,
            'sr_designation' => $request->sr_designation,
            'sr_status' => $request->sr_status,
            'sr_salary' => $request->sr_salary,
            'sr_place_of_assignment' => $request->sr_place_of_assignment,
            'sr_branch' => $request->sr_branch,
            'sr_separation_date_caused' => $request->sr_separation_date_caused,
        ]);

        $get_service_record_id = ServiceRecord::where('id', $id)->first();

        // Updating SR Request Table
        UserRequestServiceRecord::where('id', $get_service_record_id->service_request_record_id)->update([
            'created_at' => now(),
        ]);

        $notification = array(
            'message' => 'Service Record updated successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } // End Method

    public function DeleteDetailsCompletedSR($email, $id)
    {
        ServiceRecord::find($id)->delete();

        $notification = array(
            'message' => 'Service Record deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } // End Method

    public function ArchivedDetailsCompletedSR($email, $id)
    {
        UserRequestServiceRecord::where('id', $id)->update([
            'archived' => 'Yes'
        ]);

        $notification = array(
            'message' => 'Completed Request archived successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } // End Method

    // ========= Manage Archived =========
    public function AllArchivedView()
    {
        $data['allData'] = UserRequestServiceRecord::with(['user'])->where('archived', 'Yes')->orderBy('updated_at', 'DESC')->get();
        return view('admin.service_record.view_archived_record', $data);
    } // End Method

    public function RestoreArchivedView($id)
    {
        UserRequestServiceRecord::where('id', $id)->update([
            'archived' => 'No'
        ]);

        $notification = array(
            'message' => 'Data Restored successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('all.archived.view')->with($notification);
    } // End Method

    public function DeleteArchivedView($id)
    {
        UserRequestServiceRecord::find($id)->delete();
        ServiceRecord::where('service_request_record_id', $id)->delete();

        $notification = array(
            'message' => 'Data Permanently Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('all.archived.view')->with($notification);
    } // End Method

    // ========= Generate PDF =========
    public function GenerateCompletedSR($email, $id)
    {
        $alldata['allSr'] = ServiceRecord::where('service_request_record_id', $id)->orderBy('updated_at', 'DESC')->get();
        $alldata['allRequest'] = UserRequestServiceRecord::where('id', $id)->first();
        $alldata['user'] = User::where('email', $email)->first();

        // Generate PDF
        $pdf = PDF::loadView('admin.service_record.generate_sr_pdf', $alldata, [], [
            'format' => 'A4-P',
            'margin_left' => 8,
            'margin_right' => 8,
            'margin_top' => 16,
            'margin_bottom' => 16,
            // 'margin_header' => 0,
            // 'margin_footer' => 0,
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Completed_Service_Record.pdf');
    } // End Method
}
