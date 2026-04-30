<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasAnyRole(['admin', 'guru']) ?? false;
    }

    public function rules(): array
    {
        return [
            'type'           => ['required', Rule::in(['pre_test', 'post_test'])],
            'question'       => ['required', 'string', 'max:1000'],
            'option_a'       => ['required', 'string', 'max:500'],
            'option_b'       => ['required', 'string', 'max:500'],
            'option_c'       => ['required', 'string', 'max:500'],
            'option_d'       => ['required', 'string', 'max:500'],
            'correct_answer' => ['required', Rule::in(['a', 'b', 'c', 'd'])],
            'explanation'    => ['nullable', 'string', 'max:1000'],
            'order'          => ['integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'type.required'           => 'Tipe soal wajib dipilih (pre-test / post-test).',
            'question.required'       => 'Teks soal wajib diisi.',
            'option_a.required'       => 'Opsi A wajib diisi.',
            'option_b.required'       => 'Opsi B wajib diisi.',
            'option_c.required'       => 'Opsi C wajib diisi.',
            'option_d.required'       => 'Opsi D wajib diisi.',
            'correct_answer.required' => 'Jawaban benar wajib dipilih.',
            'correct_answer.in'       => 'Jawaban benar harus salah satu dari: a, b, c, d.',
        ];
    }
}
