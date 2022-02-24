<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doktor;

class HomeController extends Controller
{
    public function redirect()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype=='0')
            {
                $doctor=doktor::all();
                return view('user.home', compact('doctor'));
            }
            else
            {
                return view('admin.home');
            }
        }
        else{
            return redirect()->back();
        }
    }

    public function index()
    {
        if(Auth::id()){
            return redirect('home');
        }
        else
        {
            $doctor=doktor::all();
            return view('user.home', compact('doctor'));
        }

    }

    public function appointment(Request $request)
    {
        $data= new appointment;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->date=$request->date;
        $data->phone=$request->number;
        $data->message=$request->message;
        $data->doctor=$request->doctor;
        $data->status='In progress';
        if(Auth::id())
        {
            $data->user_id=Auth::user()->id;
        }
          $data->save();
        return redirect()->back()->with('message', 'Appointment Request Successfully .
        We will contact with you soon');
    }

    public function myappointment()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==0)
            {
            $userid=Auth::user()->id;
            $appoint=appointment::where('user_id', $userid)->get();
             return view('user.my_appointment', compact('appoint'));
            }
            else{
                return redirect()->back();
            }
        }
        else
        {
            return redirect('login');
        }


    }

    public function cancel_appoint($id)
    {
        $data = appointment::find($id);
        $data->delete();

        return redirect()->back();
    }

    public function search( Request $request)
    {
        $search=$request->search;
        $doctor=doktor::where('name', 'specialty', '%'.$search.'%')->orWhere('room')->get();

        return view('user.home', compact('doctor'));
    }
}
