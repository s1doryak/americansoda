<?php

namespace App\Repositories\Eloquent;

use App\LtpMessage;
use App\Repositories\Contracts\LtpMessageRepository;

/**
 * Class LtpMessageRepositoryEloquent
 * @package App\Repositories\Eloquent
 */
class LtpMessageRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements LtpMessageRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return LtpMessage::class;
    }
}
