<?php

$app->get('/greet/{name}', 'Actions\Greeting:greet')->setName('greet');
