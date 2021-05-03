<?php

namespace App\Repositories\Eloquent;

use App\LtpTransfer;
use App\Repositories\Contracts\LtpTransferRepository;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Str;

class LtpTransferRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements LtpTransferRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return LtpTransfer::class;
    }

    /**
     * @return string
     */
    public function getFirstAvailableNumber()
    {
        $date = date('Ymd');
        /** @var Builder|EloquentBuilder $query */
        $query = $this->model->select();
        $query->whereRaw(sprintf("`document_number` REGEXP 'LTP-%s.*'", $date));
        $transfers = $query
            ->withTrashed()
            ->get()
            ->map(function (LtpTransfer $transfer) use ($date) {
                return Str::replaceFirst(sprintf('LTP-%s-', $date), '', $transfer->document_number);
            });


        return sprintf('LTP-%s-%s', $date, $transfers->last() + 1);
    }
}
