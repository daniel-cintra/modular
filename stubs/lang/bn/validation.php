<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | O campo following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute গ্রহণ করা আবশ্যক।',
    'accepted_if' => ':attribute অবশ্যই গ্রহণ করতে হবে যখন :other সমান :value হয়।',
    'active_url' => 'এই :attribute একটি বৈধ URL নয়।',
    'after' => ':Date অবশ্যই :attribute এর পরের একটি তারিখ হতে হবে।',
    'after_or_equal' => ':attribute টি অবশ্যই :date এর সাথে মিল অথবা এর পরের একটি তারিখ হতে হবে।',
    'alpha' => ':attribute শুধুমাত্র অক্ষর থাকতে পারে।',
    'alpha_dash' => ':attribute শুধুমাত্র অক্ষর, সংখ্যা, এবং ড্যাশ থাকতে পারে।',
    'alpha_num' => ':attribute শুধুমাত্র বর্ণ ও সংখ্যা থাকতে পারে।',
    'array' => ':attribute একটি অ্যারে হতে হবে।',
    'ascii' => ':attribute টিতে শুধুমাত্র একক-বাইট বর্ণসংখ্যার অক্ষর এবং প্রতীক থাকতে হবে।',
    'attached' => 'এই :attribute ইতিমধ্যে সংযুক্ত করা হয়।',
    'before' => ':Date অবশ্যই :attribute এর আগের একটি তারিখ হতে হবে।',
    'before_or_equal' => ':attribute টি অবশ্যই :date এর সাথে মিল অথবা এর আগের একটি তারিখ হতে হবে।',
    'between' => [
        'array' => ':min এবং :max আইটেম :attribute মধ্যে হতে হবে।',
        'file' => ':min এবং :max কিলোবাইট :attribute মধ্যে হতে হবে।',
        'numeric' => ':min এবং :max :attribute মধ্যে হতে হবে।',
        'string' => ':min এবং :max অক্ষর :attribute মধ্যে হতে হবে।',
    ],
    'boolean' => ':Attribute স্থানে  সত্য বা মিথ্যা হতে হবে।',
    'can' => ':Attribute ক্ষেত্রটিতে একটি অননুমোদিত মান রয়েছে।',
    'confirmed' => ':Attribute ক্ষেত্রটি নিশ্চিতকরণ এর সাথে মিলছে না।',
    'current_password' => 'বর্তমান পাসওয়ার্ড।',
    'date' => ':Attribute একটি বৈধ তারিখ নয়।',
    'date_equals' => 'এই :attribute সমান তারিখ হতে হবে :date।',
    'date_format' => ':Attribute, :format এর সাথে বিন্যাস মিলছে না।',
    'decimal' => ':Attribute-এর অবশ্যই :decimal দশমিক স্থান থাকতে হবে।',
    'declined' => ':Attribute অবশ্যই প্রত্যাখ্যান করতে হবে।',
    'declined_if' => ':Attribute অবশ্যই প্রত্যাখ্যান করতে হবে যখন :value হবে :other।',
    'different' => ':Attribute এবং :other আলাদা হতে হবে।',
    'digits' => ':Attribute অবশ্যই একটি :digits অংকের সংখ্যা হতে হবে।',
    'digits_between' => ':Attribute অবশ্যই :min এবং :max ডিজিট এর মধ্যে হতে হবে।',
    'dimensions' => ':Attribute অবৈধ ইমেজ মাত্রা রয়েছে।',
    'distinct' => ':Attribute এর স্থানে একটি নকল মান আছে।',
    'doesnt_end_with' => ':Attribute নিম্নলিখিত: :values এর একটি দিয়ে শেষ নাও হতে পারে।',
    'doesnt_start_with' => ':Attribute :values এর একটি দিয়ে শুরু হতে পারে না।',
    'email' => ':Attribute একটি বৈধ ইমেইল ঠিকানা হতে হবে।',
    'ends_with' => ':Attribute নিম্নলিখিত এক সঙ্গে শেষ করতে হবে: :values।',
    'enum' => 'নির্বাচিত :attribute অবৈধ।',
    'exists' => 'নির্বাচিত :attribute টি অবৈধ।',
    'extensions' => ':attribute ক্ষেত্রে নিম্নলিখিত এক্সটেনশনগুলির মধ্যে একটি থাকতে হবে: :values.',
    'failed' => 'এই পরিচয়পত্র আমাদের রেকর্ডের সাথে মেলে না।',
    'file' => ':Attribute একটি ফাইল হতে হবে।',
    'filled' => ':Attribute স্থানটি পূরণ করতে হবে।',
    'gt' => [
        'array' => ':Attribute এ অবশ্যই :value আইটেমের থেকে বেশি থাকতে হবে।',
        'file' => ':Attribute অবশ্যই :value কিলোবাইটের চেয়ে বেশি হতে হবে।',
        'numeric' => ':Attribute অবশ্যই :value-এর থেকে বড় হতে হবে৷',
        'string' => ':Attribute অবশ্যই :value অক্ষরের চেয়ে বড় হতে হবে।',
    ],
    'gte' => [
        'array' => ':Attribute-এর অবশ্যই :value আইটেম বা তার বেশি থাকতে হবে।',
        'file' => ':Attribute অবশ্যই :value কিলোবাইটের থেকে বড় বা সমান হতে হবে।',
        'numeric' => ':Attribute অবশ্যই :value এর চেয়ে বড় বা সমান হতে হবে।',
        'string' => ':Attribute অবশ্যই :value অক্ষরের চেয়ে বড় বা সমান হতে হবে।',
    ],
    'image' => ':Attribute একটি ইমেজ হতে হবে।',
    'in' => 'নির্বাচিত :attribute টি অবৈধ।',
    'in_array' => ':Attribute উপাদানটি :other এ খুঁজে পাওয়া যায়নি।',
    'integer' => ':Attribute একটি পূর্ণসংখ্যা হতে হবে।',
    'ip' => ':Attribute একটি বৈধ  IP address হতে হবে।',
    'ipv4' => ':Attribute টি একটি বৈধ IPv4 address হতে হবে।',
    'ipv6' => ':Attribute টি একটি বৈধ IPv6 address হতে হবে।',
    'json' => ':Attribute একটি বৈধ JSON স্ট্রিং হতে হবে।',
    'lowercase' => ':Attribute অবশ্যই ছোট হাতের হতে হবে।',
    'lt' => [
        'array' => ':Attribute এর থেকে কম :value আইটেম থাকতে হবে।',
        'file' => ':Attribute অবশ্যই :value কিলোবাইটের চেয়ে কম হতে হবে।',
        'numeric' => ':Attribute অবশ্যই :value এর চেয়ে কম হতে হবে।',
        'string' => ':Attribute অবশ্যই :value অক্ষরের চেয়ে কম হতে হবে।',
    ],
    'lte' => [
        'array' => ':Attribute এ অবশ্যই :value আইটেমের বেশি থাকা উচিত নয়৷',
        'file' => ':Attribute অবশ্যই :value কিলোবাইটের থেকে কম বা সমান হতে হবে।',
        'numeric' => ':Attribute অবশ্যই :value এর থেকে কম বা সমান হতে হবে।',
        'string' => ':Attribute অবশ্যই :value অক্ষরের চেয়ে কম বা সমান হতে হবে।',
    ],
    'mac_address' => ':Attribute একটি বৈধ MAC ঠিকানা হতে হবে।',
    'max' => [
        'array' => ':Attribute এর মান :max টি উপাদানের চেয়ে বড় হতে পারেনা।',
        'file' => ':Attribute এর মান :max কিলোবাইট এর চেয়ে বড় হতে পারেনা।',
        'numeric' => ':Attribute এর মান :max এর চেয়ে বড় হতে পারেনা।',
        'string' => ':Attribute এর মান :max অক্ষর এর চেয়ে বড় হতে পারেনা।',
    ],
    'max_digits' => 'এই :attribute এ :max ডিজিট এর বেশি হতে পারবে না।',
    'mimes' => ':Attribute এর একটি ফাইল হতে হবে: :values।',
    'mimetypes' => ':Attribute এর একটি ফাইল হতে হবে: :values।',
    'min' => [
        'array' => ':Attribute অবশ্যই :min উপাদানের চেয়ে ছোট হতে হবে।',
        'file' => ':Attribute অবশ্যই :min কিলোবাইট এর চেয়ে ছোট হতে হবে।',
        'numeric' => ':Attribute অবশ্যই :min এর চেয়ে ছোট হতে হবে।',
        'string' => ':Attribute অবশ্যই :min অক্ষর এর চেয়ে ছোট হতে হবে।',
    ],
    'min_digits' => 'এই :attribute এ সর্বোনিম্ন :min ডিজিট হতে হবে।',
    'missing' => ':Attributeটি ক্ষেত্র অবশ্যই অনুপস্থিত।',
    'missing_if' => ':Other :value হলে :attribute ফিল্ডটি অবশ্যই অনুপস্থিত থাকবে।',
    'missing_unless' => ':Other :value না হলে :attribute ফিল্ডটি অবশ্যই অনুপস্থিত থাকবে।',
    'missing_with' => ':Values উপস্থিত থাকলে :attribute ক্ষেত্রটি অবশ্যই অনুপস্থিত থাকবে৷',
    'missing_with_all' => ':Valuesটি উপস্থিত থাকলে :attribute ক্ষেত্রটি অবশ্যই অনুপস্থিত থাকবে৷',
    'multiple_of' => 'এই :attribute একটি একাধিক :value হতে হবে।',
    'next' => 'পরবর্তী &raquo;',
    'not_in' => 'নির্বাচিত :attribute অবৈধ।',
    'not_regex' => ':Attribute বিন্যাস অবৈধ।',
    'numeric' => ':Attribute একটি সংখ্যা হতে হবে।',
    'password' => 'পাসওয়ার্ড ভুল।',
    'password' => [
        'letters' => ':Attribute -এ অন্তত একটি অক্ষর থাকতে হবে।',
        'mixed' => ':Attribute -এ অন্তত একটি বড় হাতের এবং একটি ছোট হাতের অক্ষর থাকতে হবে।',
        'numbers' => ':Attribute -এ অন্তত একটি নম্বর থাকতে হবে।',
        'symbols' => ':Attribute -এ অন্তত একটি প্রতীক থাকতে হবে।',
        'uncompromised' => 'প্রদত্ত :attribute একটি ডেটা ফাঁসের মধ্যে পাওয়া গেছে। অনুগ্রহ করে একটি ভিন্ন :attribute চয়ন করুন।',
    ],
    'present' => ':Attribute ক্ষেত্র উপস্থিত থাকা আবশ্যক।',
    'present_if' => ':attribute অবশ্যই উপস্থিত থাকতে হবে যখন :other :value হয়।',
    'present_unless' => ':attribute অবশ্যই উপস্থিত থাকতে হবে যদি না :other :value হয়।',
    'present_with' => ':attribute অবশ্যই উপস্থিত থাকতে হবে যদি :values থাকে।',
    'present_with_all' => ':attribute অবশ্যই উপস্থিত থাকতে হবে যদি :values গুলো থাকে।',
    'previous' => '&laquo; পুর্ববর্তী',
    'prohibited' => 'এই :attribute ক্ষেত্রের নিষিদ্ধ।',
    'prohibited_if' => 'এই :attribute ক্ষেত্র নিষিদ্ধ করা হয়, যখন :other হয় :value।',
    'prohibited_unless' => 'এই :attribute ক্ষেত্র নিষিদ্ধ করা হয়, যদি না, :other হয় :values।',
    'prohibits' => ':Attribute ক্ষেত্রটি :other উপস্থিত হতে নিষেধ করে৷',
    'regex' => ':Attribute বিন্যাস অবৈধ।',
    'relatable' => 'এই :attribute এই সম্পদ সঙ্গে যুক্ত হতে পারে না।',
    'required' => ':Attribute স্থানটি পূরণ করা বাধ্যতামূলক।',
    'required_array_keys' => ':Attribute ফিল্ডে অবশ্যই :values এর জন্য এন্ট্রি থাকতে হবে।',
    'required_if' => ':Attribute স্থানটি পূরণ করা বাধ্যতামূলক যেখানে :other হল :value।',
    'required_if_accepted' => ':Attribute ক্ষেত্রটি প্রয়োজন হয় যখন :other গৃহীত হয়।',
    'required_unless' => ':Attribute স্থানটি পূরণ করা বাধ্যতামূলক যদি না :other, :values তে উপস্থিত থাকে।',
    'required_with' => ':Attribute স্থানটি পূরণ করা বাধ্যতামূলক যখন  :values উপস্থিত।',
    'required_with_all' => ':Attribute স্থানটি পূরণ করা বাধ্যতামূলক যখন :values উপস্থিত।',
    'required_without' => ':Attribute স্থানটি পূরণ করা বাধ্যতামূলক যখন :values অনুপস্থিত।',
    'required_without_all' => ':Attribute স্থানটি পূরণ করা বাধ্যতামূলক যখন সকল :values অনুপস্থিত।',
    'reset' => 'আপনার পাসওয়ার্ড পুনরায় সেট করা হয়েছে!',
    'same' => ':Attribute এবং :other অবশ্যই মিলতে হবে।',
    'sent' => 'আমরা আপনার পাসওয়ার্ড পুনরায় সেট করার লিঙ্ক ই-মেইল করেছি!',
    'size' => [
        'array' => ':Attribute অবশ্যই :size আইটেম হতে হবে।',
        'file' => ':Attribute অবশ্যই :size কিলোবাইট হতে হবে।',
        'numeric' => ':Attribute অবশ্যই :size হতে হবে।',
        'string' => ':Attribute অবশ্যই :size অক্ষর হতে হবে।',
    ],
    'starts_with' => 'এই :attribute নিম্নলিখিত এক সঙ্গে শুরু হবে: :values।',
    'string' => ':Attribute একটি স্ট্রিং হতে হবে।',
    'throttle' => 'লগইন করার জন্য অনেকবার চেষ্টা করেছেন, :seconds সেকেন্ড পরে পুনরায় চেষ্টা করুন।',
    'throttled' => 'থামুন! অনুগ্রহ করে কিছুক্ষণ পর পূনরায় চেষ্টা করুন।',
    'timezone' => ':Attribute একটি বৈধ সময় অঞ্চল হতে হবে।',
    'token' => 'এই পাসওয়ার্ড রিসেট টোকেনটি সঠিক নয়।',
    'ulid' => 'এই :attribute অবশ্যই একটি বৈধ ULID হতে হবে৷',
    'unique' => ':Attribute ইতিমধ্যেই নেওয়া হয়েছে।',
    'uploaded' => ':Attribute আপলোড করতে ব্যর্থ হয়েছে।',
    'uppercase' => 'এই :attribute অবশ্যই বড় হাতের হতে হবে।',
    'url' => 'এই :attribute একটি বৈধ URL হতে হবে।',
    'user' => 'এই ই-মেইল দিয়ে কোন ব্যবহারকারী খুঁজে পাওয়া যাচ্ছে না',
    'uuid' => 'এই :attribute একটি বৈধ UUID হতে হবে।',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention 'attribute.rule' to name the lines. This makes it quick to
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
    | O campo following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as 'E-Mail Address' instead
    | of 'email'. This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'password' => 'senha',
        'name' => 'nome',
    ],

];
