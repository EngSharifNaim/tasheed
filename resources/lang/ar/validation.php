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

     'accepted'             => 'يجب قبول الحقل :attribute',
    'active_url'           => 'الحقل :attribute لا يُمثّل رابطًا صحيحًا',
    'after'                => 'يجب على الحقل :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'يجب أن لا يحتوي الحقل :attribute سوى على حروف',
    'alpha_dash'           => 'يجب أن لا يحتوي الحقل :attribute على حروف، أرقام ومطّات.',
    'alpha_num'            => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
    'array'                => 'يجب أن يكون الحقل :attribute ًمصفوفة',
    'before'               => 'يجب على الحقل :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'يجب أن تكون قيمة :attribute محصورة ما بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الملف :attribute محصورًا ما بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف النّص :attribute محصورًا ما بين :min و :max',
        'array'   => 'يجب أن يحتوي :attribute على عدد من العناصر محصورًا ما بين :min و :max',
    ],
    'boolean'              => 'يجب أن تكون قيمة الحقل :attribute إما true أو false ',
    'confirmed'            => 'حقل التأكيد غير مُطابق للحقل :attribute',
    'date'                 => 'الحقل :attribute ليس تاريخًا صحيحًا',
    'date_format'          => 'لا يتوافق الحقل :attribute مع الشكل :format.',
    'different'            => 'يجب أن يكون الحقلان :attribute و :other مُختلفان',
    'digits'               => 'يجب أن يحتوي الحقل :attribute على :digits رقمًا/أرقام',
    'digits_between'       => 'يجب أن يحتوي الحقل :attribute ما بين :min و :max رقمًا/أرقام ',
    'dimensions'           => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct'             => 'للحقل :attribute قيمة مُكرّرة.',
    'email'                => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية',
    'exists'               => 'الحقل :attribute لاغٍ',
    'file'                 => 'الـ :attribute يجب أن يكون من نوع ملف.',
    'filled'               => 'الحقل :attribute إجباري',
    'image'                => 'يجب أن يكون الحقل :attribute صورةً',
    'in'                   => 'الحقل :attribute لاغٍ',
    'in_array'             => 'الحقل :attribute غير موجود في :other.',
    'integer'              => 'يجب أن يكون الحقل :attribute عددًا صحيحًا',
    'ip'                   => 'يجب أن يكون الحقل :attribute عنوان IP ذي بُنية صحيحة',
    'json'                 => 'يجب أن يكون الحقل :attribute نصآ من نوع JSON.',
    'max'                  => [
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية أو أصغر لـ :max.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا',
        'array'   => 'يجب أن لا يحتوي الحقل :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes'                => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'mimetypes'            => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'min'                  => [
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية أو أكبر لـ :min.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت',
        'string'  => 'يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا',
        'array'   => 'يجب أن يحتوي الحقل :attribute على الأقل على :min عُنصرًا/عناصر',
    ],
    'not_in'               => 'الحقل :attribute لاغٍ',
    'numeric'              => 'يجب على الحقل :attribute أن يكون رقمًا',
    'present'              => 'يجب تقديم الحقل :attribute',
    'regex'                => 'صيغة الحقل :attribute .غير صحيحة',
    'required'             => 'الحقل :attribute مطلوب.',
    'required_if'          => 'الحقل :attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless'      => 'الحقل :attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with'        => 'الحقل :attribute إذا توفّر :values.',
    'required_with_all'    => 'الحقل :attribute إذا توفّر :values.',
    'required_without'     => 'الحقل :attribute إذا لم يتوفّر :values.',
    'required_without_all' => 'الحقل :attribute إذا لم يتوفّر :values.',
    'same'                 => 'يجب أن يتطابق الحقل :attribute مع :other',
    'size'                 => [
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية لـ :size',
        'file'    => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت',
        'string'  => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالظبط',
        'array'   => 'يجب أن يحتوي الحقل :attribute على :size عنصرٍ/عناصر بالظبط',
    ],
    'string'               => 'يجب أن يكون الحقل :attribute نصآ.',
    'timezone'             => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
    'unique'               => 'قيمة الحقل :attribute مُستخدمة من قبل',
    'uploaded'             => 'فشل في تحميل الـ :attribute',
    'url'                  => 'صيغة الرابط :attribute غير صحيحة',

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
        'name'                  => 'الاسم',
        'username'              => 'اسم المُستخدم',
        'email'                 => 'البريد الالكتروني',
        'first_name'            => 'الاسم',
        'last_name'             => 'اسم العائلة',
        'password'              => 'كلمة السر',
        'password_confirmation' => 'تأكيد كلمة السر',
        'city'                  => 'المدينة',
        'country'               => 'الدولة',
        'address'               => 'العنوان',
        'phone'                 => 'الهاتف',
        'mobile'                => 'الجوال',
        'age'                   => 'العمر',
        'sex'                   => 'الجنس',
        'gender'                => 'النوع',
        'day'                   => 'اليوم',
        'month'                 => 'الشهر',
        'year'                  => 'السنة',
        'hour'                  => 'ساعة',
        'minute'                => 'دقيقة',
        'second'                => 'ثانية',
        'title'                 => 'اللقب',
        'content'               => 'المُحتوى',
        'description'           => 'الوصف',
        'excerpt'               => 'المُلخص',
        'date'                  => 'التاريخ',
        'time'                  => 'الوقت',
        'available'             => 'مُتاح',
        'size'                  => 'الحجم',
        'active'                           => 'تفعيل' ,
        'level'                            => 'المستوى' ,
        'token'                            => 'كود ' ,
        'created_at'                       => 'انشاءه فى وقت' ,
        'parent_id'                        => 'القسم الرئيسى' ,
        'name_ar'                          => 'الاسم بااللغه العربيه' ,
        'name_en'                          => 'الاسم باللغه الانجليزيه' ,
        'url'                              => 'الرابط' ,
        'description_ar'                   => 'الوصف باللغه العربيه' ,
        'description_en'                   => 'الوصف باللغه الانجليزيه' ,
        'id'                               => 'رقم التسلسل' ,
        'conversation_id'                  => 'رقم المحادثه' ,
        'message_from'                     => 'رساله من' ,
        'message_to'                       => 'رساله الى' ,
        'details'                          => 'التفاصيل' ,
        'status'                           => 'الحاله' ,
        'viewd'                            => 'شاهد' ,
        'no_viewd'                         => 'لم يشاهد' ,
        'by'                               => 'ب' ,
        'with'                             => 'مع' ,
        'sub_section'                      => 'القسم الفرعى' ,
        'photo'                            => 'الصوره' ,
        'key'                              => 'المفتاح' ,
        'value'                            => 'القيمه' ,
        'display_name'                      => 'الاسم الظاهر' ,
        'description'                      => 'الوصف' ,
        'text'                             => 'النص' ,
        'archive'                          => 'ارشيف' ,
        'user_id'                          => ' اليوزر' ,
        'subject_id'                       => ' الموضوع' ,
        'subject_type'                     => 'نوع الموضوع' ,
        'type'                             => 'نوع' ,
        'brand_id'                         => ' الماركه' ,
        'section_id'                       => ' التصنيف' ,
        'brands'                           => 'الماركات' ,
        'sections'                         => 'التصنيفات' ,
        'logo'                             => 'اللوجو' ,
        'countrie_id'                      => ' الدوله' ,
        'citie_id'                         => ' المدينه' ,
        'color_code'                       => 'كود اللون' ,
        'size_code'                        => 'كود المقاس' ,
        'keywords_ar'                      => 'الكلمات الافتيتاحيه باللغه العربيه' ,
        'keywords_en'                      => 'الكلمات الافتيتاحيه باللغه الانجليزيه' ,
        'sub_section_id'                   => 'رقم تسلسل القسم الفرعى' ,
        'sub_sub_section_id'               => 'رقم تسلسل القسم الفرعى من الفرعى' ,
        'sub_id'                           => 'رقم تسلسل القسم الفرعى' ,
        'sub_sub_id'                       => 'رقم تسلسل القسم الفرعى من الفرعى' ,
        'image'                            => 'الصوره' ,
        'images'                           => 'الصور' ,
        'price'                            => 'السعر ' ,
        'min_price'                        => 'السعر المخفض' ,
        'views'                            => 'المشاهدات' ,
        'quantity'                         => 'الكميه' ,
        'min_quantity'                     => 'اقل كميه' ,
        'max_quantity'                     => 'اكبر كميه' ,
        'featured'                         => 'مميز' ,
        'value_to_dollar'                  => 'القيمه بالنسبه للدولار' ,
        'icon'                             => 'ايكونه' ,
        'label_ar'                         => 'الرمز باللغه العربيه' ,
        'label_en'                         => 'الرمز باللغه الانجليزيه' ,
        'rating'                           => 'التقيم' ,
        'rating_item_id'                   => 'رقم تسلسل تقيم العنصر' ,
        'comment'                          => 'الرد' ,
        'model'                            => 'مودل' ,
        'adverise_code'                    => 'كود الاعلان' ,
        'location'                         => 'مكان' ,
        'start_date'                       => 'بدايه التاريخ' ,
        'end_date'                         => 'نهايه التاريخ' ,
        // 15/4/2018 not added to english file yet
        'region_id' => ' المنقطه' ,
        'addresse' => 'العنوان' ,
        'acount_owner_name' => 'اسم صاحب الحساب',
        'bank_user_number' => 'رقم الحساب',
        'dealer_bank_number' => 'رقم حساب التاجر' ,
        'total_transfer_maney' => 'المبلغ المحول' ,
        'transfer_image' => 'صوره التحويل' ,
        'bank_name' => 'اسم البنك' ,
        'pay_notes' => 'ملاحظات الدفع' ,
        'manfacture_country' => 'بلد المنشأ' ,

    ],
];
