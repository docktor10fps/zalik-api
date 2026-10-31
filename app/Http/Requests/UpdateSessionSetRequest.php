<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSessionSetRequest extends FormRequest
{
    public function rules(): array
    {
        return $this->route('session_set')->exercise->metricRules();
    }
}
