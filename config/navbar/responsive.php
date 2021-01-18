<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "id" => "rm-menu",
    "wrapper" => null,
    "class" => "rm-default rm-mobile",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Home",
            "url" => "",
            "title" => "Home",
        ],
        [
            "text" => "About",
            "url" => "about",
            "title" => "About",
        ],
        [
            "text" => "Register",
            "url" => "user/create",
            "title" => "Register",
        ],
        [
            "text" => "Login",
            "url" => "user/login",
            "title" => "Login",
        ],
        [
            "text" => "Forum",
            "url" => "forum",
            "title" => "Forum",
        ],
        [
            "text" => "Tags",
            "url" => "tags",
            "title" => "Tags",
        ],
        [
            "text" => "Users",
            "url" => "users",
            "title" => "Users",
        ],
        [
            "text" => "Profile",
            "url" => "profile",
            "title" => "Profile",
        ],
        // [
        //     "text" => "Redovisning",
        //     "url" => "redovisning",
        //     "title" => "Redovisningstexter från kursmomenten.",
        //     "submenu" => [
        //         "items" => [
        //             [
        //                 "text" => "Kmom01",
        //                 "url" => "redovisning/kmom01",
        //                 "title" => "Redovisning för kmom01.",
        //             ],
        //             [
        //                 "text" => "Kmom02",
        //                 "url" => "redovisning/kmom02",
        //                 "title" => "Redovisning för kmom02.",
        //             ],
        //         ],
        //     ],
        // ],
        // [
        //     "text" => "Om",
        //     "url" => "om",
        //     "title" => "Om denna webbplats.",
        // ],
        // [
        //     "text" => "Styleväljare",
        //     "url" => "style",
        //     "title" => "Välj stylesheet.",
        // ],
        // [
        //     "text" => "Verktyg",
        //     "url" => "verktyg",
        //     "title" => "Verktyg och möjligheter för utveckling.",
        // ],
    ],
];
