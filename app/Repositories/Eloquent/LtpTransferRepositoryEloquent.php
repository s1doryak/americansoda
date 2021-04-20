<?php

namespace App\Repositories\Eloquent;

use App\LtpTransfer;
use App\Repositories\Contracts\LtpTransferRepository;

class LtpTransferRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements LtpTransferRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return LtpTransfer::class;
    }
}
