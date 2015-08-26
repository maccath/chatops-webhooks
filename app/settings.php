<?php

return [
    // Slack webhook settings
    'SlackIncomingWebhook' => [
    ],

    // Customisable settings for individual actions
    'Actions\Greeting' => [
        'icon_emoji' => ':wave:',
        'username' => 'Greetings Bot',
        'authentication' => [
            'token' => false
        ],
    ],
    'Actions\Date' => [
        'icon_emoji' => ':calendar:',
        'username' => 'Date Bot',
        'authentication' => [
            'token' => false
        ],
    ],
];