<?php

namespace App\Http\Requests;

use App\Competition;
use Illuminate\Foundation\Http\FormRequest;

class CompetitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $data = $this->validationData();
        $validateRules = [
            'name' => 'required|string|max:255',
            'start_at' => 'required|date_format:d-m-Y',
            'type' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png',
            'address' => 'nullable|string|max:255',
            'desc' => 'nullable|string|max:255',
        ];
        if($this->id) {
            $validateRules = [
                'name' => 'required|string|max:255',
                'start_at' => 'required|date_format:d-m-Y',
                'type' => 'required',
                'image' => 'image|mimes:jpeg,jpg,png',
                'address' => 'nullable|string|max:255',
                'desc' => 'nullable|string|max:255',
            ];
        }

        $validateRules['end_at'] = [
            'required',
            'date_format:d-m-Y',
            function($attribute, $value, $fail) use ($data) {
                if (strtotime($data['start_at']) >= strtotime($data['end_at'])) {
                    return $fail('end_date_lower_date_start');
                }
            },
            function($attribute, $value, $fail) use ($data)  {
                $startAt = strtotime($data['start_at']);
                $endAt = strtotime($data['end_at']);
                $competitions = Competition::where('type', '=', $data['type'])->where(function($query) use ($startAt, $endAt) {
                    $query
                        ->where(function ($time) use ($startAt, $endAt) {
                            $time->where('start_at', '<=', $startAt);
                            $time->where('end_at', '>', $startAt);
                            $time->where('start_at', '<', $endAt);
                            $time->where('end_at', '>=', $endAt);
                        })
                        ->orWhere(function ($time) use ($startAt, $endAt) {
                            $time->where('end_at', '>', $startAt);
                            $time->where('end_at', '<=', $endAt);
                        })
                        ->orWhere(function ($time) use ($startAt, $endAt) {
                            $time->where('start_at', '>=', $startAt);
                            $time->where('start_at', '<', $endAt);
                        });
                });

                if($this->id) {
                    $competitions->where('id', '!=', $this->id);
                }
                $competitions = $competitions->count();
                if($competitions){
                    return $fail('superposition_period');
                }

            }];
        return $validateRules;
    }
}
