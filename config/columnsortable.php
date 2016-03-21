<?php

return [

    /*
    spec columns
    */
    'columns' => [
        'alpha'    => [
            'rows' => ['description', 'email', 'name', 'slug'],
            'class' => 'icon-sort-by-alphabet',
        ],
        'amount'   => [
            'rows' => ['amount', 'price'],
            'class' => 'icon-sort-by-attributes'
        ],
        'numeric'  => [
            'rows' => ['created_at', 'updated_at', 'level', 'id', 'phone_number'],
            'class' => 'icon-sort-by-order'
        ],
    ],

    /*
    defines icon set to use when sorted data is none above (alpha nor amount nor numeric)
    */
    'default_icon_set' => 'icon-sort',

    /*
    icon that shows when generating sortable link while column is not sorted
    */
    'sortable_icon'    => 'icon-sort',

    /*
    suffix class that is appended when ascending order is applied
    */
    'asc_suffix'        => '',

    /*
    suffix class that is appended when descending order is applied
    */
    'desc_suffix'       => '-alt',

    /*
    default anchor class, if value is null none is added
    */
    'anchor_class'      => null,

    /*
    relation - column separator. ex: detail.phone_number means relation "detail" and column "phone_number"
     */
    'uri_relation_column_separator' => '.'

];
