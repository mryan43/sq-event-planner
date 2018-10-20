<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventRegistration;
use App\RegistrationValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($eventId)
    {
        $registration = EventRegistration::where('event_id', $eventId)->where('user_id', 43/*auth()->user()->id*/);

        if ($registration->exists()){
            return redirect()->route('events.registration.show', ['event' => $eventId,'registration' => $registration->first()->id]);
        }

        $event = Event::findOrFail($eventId);

        return view("registrations.form", [
            'event' => $event,
            'user' => ['id' => 43]/*auth()->user()*/,
            'mode' => 'create'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($eventId, Request $request)
    {
        $request->validate([
            'field-1'=>'required'
        ]);

        $event = Event::findOrFail($eventId);

        DB::transaction(function() use ($event, $request){
            $registration = EventRegistration::where('user_id', 43)->where("event_id", $event->id);
            if (!$registration->exists()){
                $registration = new EventRegistration([
                    'user_id' => 43/*auth()->user()->id*/,
                    'event_id'=> $event->id
                ]);
                $registration->save();
            }

            RegistrationValue::where('event_registration_id', $registration->first()->id)->delete();

            $value = new RegistrationValue([
                'event_registration_id' => $registration->first()->id,
                'field_id' => 1,
                'value' => $request->input("field-1")
            ]);

            $value->save();

            foreach ($event->fields as $field){

                if ($field->type === "doubletext"){
                    $content = $request->input("field-".$field->id."-1")."|".$request->input("field-".$field->id."-2");
                } else {
                    $content = $request->input("field-".$field->id);
                }

                $value = new RegistrationValue([
                    'event_registration_id' => $registration->first()->id,
                    'field_id' => $field->id,
                    'value' => $content
                ]);
                Log::info("Saving value");
                $value->save();
            }
        });

        $registration = EventRegistration::where('user_id', 43)->where("event_id", $eventId);
        $registrationId = $registration->first()->id;

        return redirect("/events/$eventId/registration/$registrationId")->with('success', 'Your registration was saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($eventId)
    {
        $event = Event::findOrFail($eventId);

        $registration = EventRegistration::where('event_id', $eventId)->where('user_id', 43/*auth()->user()->id*/);

        if (!$registration->exists()){
            redirect("events.registration.create", ['event' => $eventId]);
        }

        $values = RegistrationValue::where('event_registration_id', $registration->first()->id);

        $values = $values->get()->mapWithKeys(function ($item) {
            return [$item['field_id'] => $item['value']];
        });

        return view("registrations.form", [
            'event' => $event,
            'user' => ['id' => 43]/*auth()->user()*/,
            'values' => $values,
            'mode' => 'show'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
