<?php

namespace App\Starter\Categories\Requests;

use Carbon\Carbon;
use App\Starter\Users\User;
use Illuminate\Validation\Rule;
use App\Starter\Users\UserEnums;
use Illuminate\Support\Facades\Auth;
use App\Starter\BaseApp\Requests\BaseAppRequest;

class QuestionRequest extends BaseAppRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question' => 'required',
            'question_recommendation' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'question.required' => 'السؤال مطلوب',
            'question_recommendation.required' => 'التوصيه مطلوب',
        ];
    }


}
