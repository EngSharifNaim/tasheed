<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'filled'               => 'The :attribute field is required.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes'           => [
        'name'                  => 'name',
        'username'              => 'username',
        'email'                 => 'email',
        'first_name'            => 'first name',
        'last_name'             => 'last name',
        'password'              => 'password',
        'password_confirmation' => ' confirm password ',
        'city'                  => 'city',
        'country'               => 'country',
        'address'               => 'address',
        'phone'                 => 'phone',
        'mobile'                => 'mobile',
        'age'                   => 'age',
        'sex'                   => 'sex',
        'gender'                => 'gender',
        'day'                   => 'day',
        'month'                 => 'month',
        'year'                  => 'year',
        'hour'                  => 'hour',
        'minute'                => 'minute',
        'second'                => 'second',
        'title'                 => 'title',
        'content'               => 'content',
        'description'           => 'description',
        'excerpt'               => 'excerpt',
        'date'                  => 'date',
        'time'                  => 'time',
        'available'             => 'available',
        'size'                  => 'size',
        'active'                => 'active' ,
        'level'                 => 'level' ,
        'token'                 => 'token' ,
        'created_at'            => 'created at' ,
        'parent_id'             => 'parentid' ,
        'name_ar'               => 'Arabic Name' ,
        'name_en'               => 'English Name' ,
        'url'                   => 'url' ,
        'description_ar'        => 'description Arabic' ,
        'description_en'        => 'description English' ,
        'id'                    => 'id' ,
        'conversation_id'       => 'conversation id' ,
        'message_from'          => 'message from' ,
        'message_to'            => 'message to' ,
        'details'               => 'details' ,
        'status'                => 'status' ,
        'viewd'                 => 'viewd' ,
        'no_viewd'              => 'not viewed' ,
        'by'                    => 'by' ,
        'with'                  => 'with' ,
        'sub_section'           => 'sub section' ,
        'photo'                 => 'photo' ,
        'key'                   => 'key' ,
        'value'                 => 'value' ,
        'display_name'          => 'display name' ,
        'description'           => 'description' ,
        'text'                  => 'text' ,
        'archive'               => 'archive' ,
        'user_id'               => 'user id' ,
        'subject_id'            => 'subject id' ,
        'subject_type'          => 'subject type' ,
        'type'                  => 'type' ,
        'brand_id'              => 'brand id' ,
        'section_id'            => 'section id' ,
        'brands'                => 'brands' ,
        'sections'              => 'sections' ,
        'logo'                  => 'logo' ,
        'countrie_id'           => 'countrie id' ,
        'citie_id'              => 'citie id' ,
        'color_code'            => 'color  code' ,
        'size_code'             => 'size Code' ,
        'keywords_ar'           => 'Arabic keywords' ,
        'keywords_en'           => 'English keywords' ,
        'sub_section_id'        => 'sub section id' ,
        'sub_sub_section_id'    => 'sub sub section id' ,
        'section_id'            => 'section id' ,
        'sub_id'                => 'sub id' ,
        'sub_sub_id'            => 'sub sub id' ,
        'image'                 => 'image' ,
        'images'                => 'images' ,
        'price'                 => 'price' ,
        'min_price'             => 'min price' ,
        'views'                 => 'views' ,
        'quantity'              => 'quantity' ,
        'min_quantity'          => 'min quantity' ,
        'max_quantity'          => 'max quantity' ,
        'featured'              => 'featured' ,
        'value_to_dollar'       => 'value to dollar' ,
        'icon'                  => 'icon' ,
        'label_ar'              => 'label Arabic' ,
        'label_en'              => 'label English' ,
        'rating'                => 'rating' ,
        'rating_item_id'        => 'rating item  id' ,
        'comment'               => 'comment' ,
        'model'                 => 'model' ,
        'adverise_code'         => 'adverise code' ,
        'location'              => 'location' ,
        'start_date'            => 'start date' ,
        'end_date'              => 'end date' ,
        'region_id' => ' Region' ,
        'addresse' => 'addresse' ,
        'acount_owner_name' => 'user  owner name',
        'bank_user_number' => 'bank_user_number',
        'dealer_bank_number' => 'dealer_bank_number' ,
        'total_transfer_maney' => ' total_transfer_maney' ,
        'transfer_image' => 'transfer_image' ,
        'bank_name' => 'bank_name ' ,
        'pay_notes' => 'pay_notes' ,
    ],

];
