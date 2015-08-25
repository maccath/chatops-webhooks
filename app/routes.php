<?php

$app->post('/greet', 'Actions\Greeting:greet')->setName('greet');

$app->post('/date', 'Actions\Date:getDate')->setName('date');
