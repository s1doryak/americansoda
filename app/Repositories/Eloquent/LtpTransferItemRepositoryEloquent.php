<?php

namespace App\Repositories\Eloquent;

use App\LtpTransferItem;
use App\Repositories\Contracts\LtpTransferItemRepository;

class LtpTransferItemRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements LtpTransferItemRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return LtpTransferItem::class;
    }
}
