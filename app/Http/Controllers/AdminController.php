<?php

namespace App\Http\Controllers;

use App\Models\Doktor;
use App\Models\Appointment;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function addview()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1)
            {
                return view('admin.add_doctor');
            }
            else {
                return redirect()->back();
            }
        }
        else {
            return redirect('login');
        }
    }


    public function upload(Request $request)
    {
        $doctor = new Doktor;
        $image = $request->file;
        $image_name = ('doctor') . '-' . microtime('true') . '.' . $image->getClientoriginalExtension();
        $request->file->move('doctor_image', $image_name);
        $doctor->image = $image_name;
        $doctor->name = $request->name;
        $doctor->phone = $request->number;
        $doctor->room = $request->room;
        $doctor->specialty = $request->specialty;

        $doctor->save();
        return redirect()->back()->with('message', 'Doctor Added Successfully');
    }

    public function showappointment()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
            {
              $data = appointment::all();
              return view('admin.showappointment', compact('data'));
            }
            else {
                return redirect()->back();
            }
        }
        else {
            return redirect('login');
        }
    }

    public function approved($id)
    {
        $data = appointment::find($id);
        $data->status = 'approved';
        $data->save();
        return redirect()->back();
    }

    public function canceled($id)
    {
        $data = appointment::find($id);
        $data->status = 'canceled';
        $data->save();
        return redirect()->back();
    }

    public function showdoctor()
    {
        $data = Doktor::all();

        return view('admin.show_doctor', compact('data'));
    }

    public function deletedoctor($id)
    {
        $data = doktor::find($id);

        $data->delete();

        return redirect()->back();
    }

    public function updatedoctor($id)
    {
        $data = doktor::find($id);
        return view('admin.update_doctor', compact('data'));
    }

    public function editdoctor( Request $request, $id)
    {
        $doctor=doktor::find($id);
        $doctor->name=$request->name;
        $doctor->phone=$request->phone;
        $doctor->specialty=$request->specialty;
        $doctor->room=$request->room;
        $image=$request->file;
        if ($image){
            $image_name = ('doctor') . '-' . microtime('true') . '.' . $image->getClientOriginalExtension();
            $request->file->move('doctor_image', $image_name);
            $doctor->image = $image_name;
        }
        $doctor->save();
        return redirect()->back()->with('message', 'Doctor Details Updated Successfully');
    }
    public function emailview($id)
    {
        $data=appointment::find($id);
        return view('admin.email_view', compact('data'));
    }
    public function sendemail( Request $request, $id)
    {
        $data=appointment::find($id);
        $details=[
            'greeting'=>$request->greeting,
            'body'=>$request->body,
            'actiontext'=>$request->actiontext,
            'actionurl'=>$request->actionurl,
            'endpart'=>$request->endpart,

        ];

        Notification::send($data, new SendEmailNotification($details));

        return redirect()->back()->with('message', 'Email send is successfully');
    }

}
