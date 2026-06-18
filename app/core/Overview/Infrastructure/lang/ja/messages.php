<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 月
    |--------------------------------------------------------------------------
    */
    'month' => [
        'january'   => '1月',
        'february'  => '2月',
        'march'     => '3月',
        'april'     => '4月',
        'may'       => '5月',
        'june'      => '6月',
        'july'      => '7月',
        'august'    => '8月',
        'september' => '9月',
        'october'   => '10月',
        'november'  => '11月',
        'december'  => '12月',
    ],

    /*
    |--------------------------------------------------------------------------
    | 概要
    |--------------------------------------------------------------------------
    */
    'overview' => [

        'type' => [
            // 月次
            'monthly_orders'    => '月間注文数',
            'monthly_products'  => '月間商品数',
            'monthly_customers' => '月間顧客数',
            'monthly_purchase'  => '月間仕入れ',

            // 売上
            'daily_revenues'    => '日次売上',
            'weekly_revenues'   => '週次売上',
            'monthly_revenues'  => '月次売上',
            'yearly_revenues'   => '年次売上',

            // 支出
            'daily_expenses'    => '日次支出',
            'weekly_expenses'   => '週次支出',
            'monthly_expenses'  => '月次支出',
            'yearly_expenses'   => '年次支出',
        ],

        'compare' => [
            'last_day'   => '前日比',
            'last_week'  => '前週比',
            'last_month' => '前月比',
            'last_year'  => '前年比',
        ],
    ],
];
