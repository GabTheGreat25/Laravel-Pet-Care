<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;


class ExcelRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(UploadedFile $file)
    {
        //

        $this->file = $file;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //

         $extension = strtolower($this->file->getClientOriginalExtension());

        return in_array($extension, ['csv', 'xls', 'xlsx']);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
         return ' The excel file must be a file of type: xls, xlsx.';
    }
}
