<?php

namespace Crmplease\Generators\Console\Commands\Contracts;

interface HasModelAttributes
{
    const PROTECTED = [
        'password',
        'remember_token',
        'email_verified_at',
    ];
}
