<?php

namespace App\Http\Controllers\Dashboard;

use App\CustomerOrder;
use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Eloquent\CustomerOrderRepositoryEloquent;
use Carbon\Carbon;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Routing\Controller;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Home controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class HomeController extends Controller
{
    use DashboardSidebar;

    /**
     * @var Gate
     */
    protected $gate;

    /**
     * @var string
     */
    protected $prefix = 'dashboard';

    /**
     * JobsController constructor.
     * @param Gate $gate
     */
    public function __construct(Gate $gate)
    {
        $this->gate = $gate;

        $this->middleware('auth:dashboard');
        $this->shareSidebar();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return redirect(route('dashboard.customer_order_item.index'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function calendar()
    {
        return view(
            'dashboard::calendar.index',
            [
                'title' => trans('calendar.index.title'),
            ]
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function calendarJson(Request $request)
    {
        /** @var CustomerOrderRepositoryEloquent $repository */
        $repository = app(CustomerOrderRepository::class);

        /** @var Collection|CustomerOrder[] $orders */
        $orders = $repository->with(['customer', 'customerOrderItems'])->getValidOrders(
            $request->get('start'),
            $request->get('end')
        );
//        dd($request->get('start'),
//            $request->get('end'));
        /** @var Collection|CustomerOrder[] $last */
        $last = $repository->with(['customer', 'customerOrderItems'])->getLastOrders();

        /** @var Collection $events */
        $events = $orders->map(
            function ($order) {
                /** @var CustomerOrder $order */
                return $order->toFcEvent();
            }
        );

        if ($last->count()) {

            $last->map(
                function ($order) use ($events) {
                    /** @var CustomerOrder $order */
                    $event = $order->toFcEvent();

                    /** @var Carbon $date */
                    $date = Carbon::createFromFormat('Y-m-d', $order->future_date);

                    $event['type'] = 'future';
                    $event['id'] = $event['id'] . '_' . $event['type'];
                    $event['editable'] = true;
                    $event['start'] = $date->addDays($order->fc_overdue)->toIso8601String();
                    $event['className'] = $event['className'] . ' bgm-pink';

                    if (!empty(trim(strip_tags($order->fc_future_comment)))) {
                        $event['className'] = $event['className'] . ' fc-order-has-future-comment';
                    }

                    $events->push($event);
                }
            );
        }

        return json($events->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function calendarUpdate(Request $request)
    {
        $response = [];

        /** @var CustomerOrderRepositoryEloquent $repository */
        $repository = app(CustomerOrderRepository::class);

        $event = $request->get('event');

        $order_id = Arr::get($event, 'order');

        /** @var Carbon $date */
        $date = Carbon::createFromFormat('d-m-Y', Arr::get($event, 'start'));

        /** @var \App\CustomerOrder $order */
        $order = $repository->with(['customer'])->find($order_id);

        /** @var \App\Customer $customer */
        $customer = $order->customer;

        $interval = (int)$customer->order_interval;

        $overdue = $date->diffInDays($order->getDate()) - $interval;

        if ($overdue >= 0) {

            $order->update([
                'fc_overdue' => $overdue
            ]);

        }

        $response['overdue'] = $overdue;

        $type = Arr::get($event, 'type');

        if ($type == 'future') {

            $comment = Arr::get($event, 'future_comment');

        } else {

            $comment = Arr::get($event, 'comment');

        }

        $customer->update([
            'calendar_comment' => $comment
        ]);


        $response['comment'] = $comment;
        $response['has_comment'] = !empty(trim(strip_tags($comment)));
        $response['className'] = Arr::get($event, 'className');

        return json($response);
    }
}
