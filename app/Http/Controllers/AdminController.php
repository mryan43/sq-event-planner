<?php
/**
 * Created by IntelliJ IDEA.
 * User: mryan
 * Date: 18.10.18
 * Time: 16:29
 */

namespace App\Http\Controllers;


use App\Event;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }


    public function export($id)
    {

        $this->authorize('admin');
        $csv = Writer::createFromFileObject(new \SplTempFileObject());

        $event = Event::findOrFail($id);
        $header = ["Person Name", "Department", "Will you be present at this event ?", "Why not ? (optional)"];
        foreach ($event->fields->sortBy('id') as $field) {
            array_push($header, $field->label);
        }

        $fieldsById = $event->fields->mapWithKeys(function ($item) {
            return [$item->id => $item];
        });

        $csv->insertOne($header);

        $records = DB::table('registration_values')
            ->join('event_registrations', 'registration_values.event_registration_id', '=', 'event_registrations.id')
            ->join('users', 'event_registrations.user_id', '=', 'users.id')
            ->join('fields', 'fields.id', '=', 'registration_values.field_id')
            ->select('registration_values.value as value', 'fields.label as fieldname', 'fields.id as fieldid', 'users.name as username',
                'users.department as department')
            ->orderBy('username', 'fieldid')
            ->where('event_registrations.event_id', $id)->get();

        $map = [];

        foreach ($records as $record) {
            $map[$record->username]['department'] = $record->department;
            $map[$record->username][$record->fieldid] = $record->value;
        }

        // sort by username
        ksort($map);
        // sort answers by field id
        ksort($map[$record->username]);

        // hide irrelevant answers (conditional fields)
        foreach ($map as $username => $answers) {
            foreach ($answers as $fieldid => $value) {
                // why not ?
                if ($fieldid == 2 && $answers[1] === "Yes") {
                    $map[$username][$fieldid] = "";
                }

                if ($fieldid < 3 || $fieldid === "department") {
                    continue;
                }

                $condition = $fieldsById[$fieldid]->condition;
                if (!empty($condition)) {
                    $conditionFieldId = preg_split("~:~", $condition)[0];
                    $conditionValue = preg_split("~:~", $condition)[1];
                    if ($answers[$conditionFieldId] !== $conditionValue) {
                        $map[$username][$fieldid] = "";
                    }
                }

                // non participating
                if ($answers[1] === "No") {
                    $map[$username][$fieldid] = "";
                }

            }
        }

        // insert in CSV
        foreach ($map as $username => $answers) {
            $row = [$username];
            foreach ($answers as $fieldid => $value) {
                array_push($row, $value);
            }
            $csv->insertOne($row);
        }
        $csv->output($event->name . '.csv');
    }
}
