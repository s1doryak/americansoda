<?php

/**
 * JSON response helper.
 *
 * @param array $data
 * @param integer $status
 * @param array $headers
 * @param integer $options
 * @return \Illuminate\Http\JsonResponse
 */
function json(array $data = [], $status = 200, array $headers = [], $options = 0)
{
    return Response::json($data, $status, $headers, $options);
}

/**
 * Check if string is valid JSON string.
 *
 * @param string $string
 * @return boolean
 */
function is_json($string = '')
{

    if (empty($string)) {
        return false;
    }

    json_decode($string);

    return json_last_error() === JSON_ERROR_NONE;
}

/**
 * Check if string is valid URL string.
 *
 * @param $string
 *
 * @return mixed
 */
function is_url($string = '')
{
    return Str::startsWith($string, ['http://', 'https://']);
}

/**
 * Check if string is bcrypt hash.
 *
 * @param string $string
 *
 * @return int
 */
function is_bcrypt($string = '')
{
    return preg_match('/^\$2[ayb]\$.{56}$/ui', $string);
}

/**
 * @return boolean
 */
function is_ajax()
{
    return Request::ajax();
}

/**
 * @return boolean
 */
function has_prefix()
{
    return in_array(prefix_name(), array_keys(config('namespaces', [])));
}

/**
 * Return a resource prefix.
 *
 * @return string
 */
function prefix_name()
{
    $route = Route::getCurrentRoute();

    return Str::replaceFirst('/', '', $route ? $route->getPrefix() : '');
}

/**
 * Return a resource name.
 *
 * @return string
 */
function resource_name()
{
    $resources = config('resources', []);

    $route = Route::getCurrentRoute();

    $routeName = $route ? Arr::get($route->getAction(), 'as') : '';

    if (prefix_name()) {
        $routeName = Str::replaceFirst(sprintf('%s.', prefix_name()), '', $routeName);
    }

    $resourceName = substr($routeName, 0, strrpos($routeName, '.'));

    return in_array($resourceName, array_keys($resources)) ? $resourceName : '';
}

/**
 * Return a resource model.
 *
 * @return string
 */
function resource_model()
{
    $resources = config('resources', []);

    return Arr::get($resources, resource_name(), '');
}

/**
 * Return current resource ID.
 *
 * @param string $name
 *
 * @return string
 */
function resource_id($name = null)
{
    /** @var \Illuminate\Routing\Route $route */
    $route = Route::getCurrentRoute();

    return $route ? $route->parameter($name ?: resource_name()) : null;
}

/**
 * Construct a resource's create URL.
 *
 * @return string
 */
function resource_url($action)
{
    return app(\Crmplease\MaterialAdmin\Forms\Extensions\FormUrlBuilder::class)
        ->setResource(resource_name())
        ->setPrefix(prefix_name())
        ->getUrl($action);
}

/**
 * Construct a resource's create URL.
 *
 * @return string
 */
function resource_create_url()
{
    return resource_url('create');
}

/**
 * Construct a resource's index URL.
 *
 * @return string
 */
function resource_index_url()
{
    return resource_url('index');
}

/**
 * Construct a resource's trashed URL.
 *
 * @return string
 */
function resource_trashed_url()
{
    return resource_url('trashed');
}

/**
 * Construct a resource's destroy URL.
 *
 * @return string
 */
function resource_restore_url()
{
    return resource_url('restore');
}

/**
 * Construct a resource's destroy URL.
 *
 * @return string
 */
function resource_destroy_url()
{
    return resource_url('destroy');
}

/**
 * Construct a resource's current action.
 *
 * @return string
 */
function resource_action()
{
    /** @var \Illuminate\Routing\Route $route */
    $route = Route::getCurrentRoute();

    return explode('@', $route->getActionName())[1];
}

/**
 * @param $action
 * @return boolean
 */
function is_page($action)
{
    /** @var \Illuminate\Routing\Route $route */
    $route = Route::getCurrentRoute();

    return $route ? Str::endsWith($route->getName(), $action) : false;
}

/**
 * @param null $resource
 * @return boolean
 */
function is_datatable($resource = null)
{
    return is_page('.index') && ($resource ? in_array(resource_name(), (array)$resource) : true);
}

/**
 * Check whether current page is a resource page.
 *
 * @return boolean
 */
function is_resource_page($resource = null)
{
    $actions = [
        '.trashed',
        '.index',
        '.show',
        '.create',
        '.store',
        '.edit',
        '.update',
    ];

    return is_page($actions) && ($resource ? in_array(resource_name(), (array)$resource) : true);
}

/**
 * Check whether current page is resource's create page.
 *
 * @return boolean
 */
function is_create_page()
{
    return is_page('.create');
}

/**
 * Check whether current page is resource's edit page.
 *
 * @return boolean
 */
function is_edit_page()
{
    return is_page('.edit');
}

/**
 * Check whether current page is resource's index.
 *
 * @return boolean
 */
function is_index_page()
{
    return is_page('.index') || is_page('.trashed');
}

/**
 * Check whether current page is resource's index.
 *
 * @return boolean
 */
function is_trashed_page()
{
    return is_page('.trashed');
}

/**
 * Check whether current user is allowed to edit the resource.
 *
 * @return boolean
 */
function can_show_resource_action()
{
    $model = resource_model();
    $action = 'action';
    $policy = sprintf('%s-%s', $action, Str::camel(class_basename($model)));

    if (Gate::getPolicyFor($model)) {
        return Gate::allows($action, $model);
    } elseif (Gate::has($policy)) {
        return Gate::allows($policy);
    } else {
        return false;
    }
}

/**
 * Check whether current user is allowed to create the resource.
 *
 * @return boolean
 */
function can_create_resource()
{
    $model = resource_model();
    $action = 'create';
    $policy = sprintf('%s-%s', $action, Str::camel(class_basename($model)));

    if (Gate::getPolicyFor($model)) {
        return Gate::allows($action, $model);
    } elseif (Gate::has($policy)) {
        return Gate::allows($policy);
    } else {
        return true;
    }
}

/**
 * Check whether current user is allowed to edit the resource.
 *
 * @return boolean
 */
function can_edit_resource($model)
{
    $model = $model ?: resource_model();
    $action = 'update';
    $policy = sprintf('%s-%s', $action, Str::camel(class_basename($model)));

    if (Gate::getPolicyFor($model)) {
        return Gate::allows($action, $model);
    } elseif (Gate::has($policy)) {
        return Gate::allows($policy);
    } else {
        return true;
    }
}

/**
 * Check whether current user is allowed to create the resource.
 *
 * @return boolean
 */
function can_delete_resource($model)
{
    $model = $model ?: resource_model();
    $action = 'trash';
    $policy = sprintf('%s-%s', $action, Str::camel(class_basename($model)));

    if (Gate::getPolicyFor($model)) {
        return Gate::allows($action, $model);
    } elseif (Gate::has($policy)) {
        return Gate::allows($policy);
    } else {
        return true;
    }
}

/**
 * @param array $attributes
 *
 * @return string
 */
function html_attrs(array $attributes = [])
{
    return Html::attributes($attributes);
}

/**
 * Check resource controller exists in given namespace
 *
 * @param string $resource
 * @param string $controller
 * @param string $namespace
 * @return boolean
 */
function has_controller($resource, $controller, $namespace)
{
    return class_exists($controller)
        ?: class_exists(
            sprintf('%s\%s',
                get_controller_namespace($namespace),
                get_controller_name($resource)
            )
        );
}

/**
 * Get controller namespace
 *
 * @param string $namespace
 * @return string
 */
function get_controller_namespace($namespace)
{
    return config(sprintf('namespaces.%s', $namespace), '');
}

/**
 * Get controller name by resource
 *
 * @param string $resource
 * @return string
 */
function get_controller_name($resource)
{
    return Str::studly(sprintf('%s_controller', Str::plural(class_basename($resource))));
}

/**
 * Get resources for given namespace.
 *
 * @return array
 */
function get_route_resources()
{
    $resources = config('resources', []);

    $controllers = array_map(
        function ($resource) use ($resources) {

            return get_controller_name($resources[$resource]);

        },
        array_keys($resources)
    );

    return array_combine(array_keys($resources), $controllers);
}

/**
 * Check whether the given sidebar links group is active.
 *
 * @param array $group
 * @return boolean
 */
function is_active_sidebar_group(array $group)
{
    $routes = array_map(
        function ($resource) {
            $resource = (array)$resource;

            return (string)$resource[0];

        },
        $group['resources']
    );

    $current = resource_name();

    foreach ($routes as $route) {
        if ($route == $current) {
            return true;
        }
    }

    return false;
}

/**
 * Check whether the route is active.
 *
 * @param string $route
 * @return boolean
 */
function is_active_route($needled)
{
    /** @var \Illuminate\Routing\Route $route */
    $route = Route::getCurrentRoute();

    return $needled == $route ? $route->getName() : null;
}

/**
 * @return string
 */
function deep_link_route()
{
    $route = call_user_func_array('route', func_get_args());

    return Str::replaceFirst(config('app.url'), sprintf('%s://', config('app.deeplink')), $route);
}

/**
 * Make value a proper boolean.
 *
 * @param string $value
 * @return boolean
 */
function booleanize($value)
{
    switch (Str::lower($value)) {
        case 'true':
            return true;
        case 'false':
            return false;
        default:
            return intval(str_replace(',', '.', preg_replace('/[^0-9,.\-]/', '', $value))) !== 0;
    }
}

/**
 * Make value a proper integer.
 *
 * @param string $value
 * @return integer
 */
function numerize($value)
{
    return intval(str_replace(',', '.', preg_replace('/[^0-9,.\-]/', '', $value)));
}

/**
 * Make value a proper float.
 *
 * @param string $value
 * @return float
 */
function floatize($value)
{
    return floatval(str_replace(',', '.', preg_replace('/[^0-9,.\-]/', '', $value)));
}

/**
 * @param $number
 * @param integer $decimals
 * @param string $dec_point
 * @param string $thousands_sep
 * @return string|string[]|null
 */
function auto_number_format($number, $decimals = 0, $dec_point = '.', $thousands_sep = ',')
{
    $canonical = number_format($number, $decimals, $dec_point, $thousands_sep);

    return preg_replace_callback(
        '/([0-9]{2})([0-9]{2})$/mui',
        function ($matches) {
            return sprintf('%s%s', $matches[1], preg_replace('/0+$/mui', '', $matches[2]));
        },
        $canonical
    );
}

/**
 * Format date to a more suitable format.
 *
 * @param \Carbon\Carbon $date
 *
 * @return string
 */
function format_date($date)
{
    if (!$date) {
        return '';
    }

    if ($date->isToday()) {
        $format = 'H:i';
    } else {
        if ($date->isCurrentYear()) {
            if ($date->isCurrentMonth()) {
                $format = 'd/m/Y H:i';
            } else {
                $format = 'd/m/Y';
            }
        } else {
            $format = 'd/m/Y';
        }
    }

    return $date->format($format);
}

/**
 * @param $date
 * @param string $format
 * @return boolean
 */
function is_date($date, $format = 'Y-m-d H:i:s')
{
    try {
        return (boolean)\Carbon\Carbon::createFromFormat($format, $date);
    } catch (\Exception $e) {
        return false;
    }
}

/**
 * @param $date
 * @param string $format
 * @return boolean|\Carbon\Carbon|\Carbon\CarbonInterface|DateTime
 */
function carbon($date = null, $format = 'Y-m-d H:i:s')
{
    if (is_date($date, $format)) {
        return \Carbon\Carbon::createFromFormat($format, $date);
    }

    return \Carbon\Carbon::now();
}

/**
 * @param $route
 *
 * @return boolean
 */
function has_route($route)
{
    return Route::has($route);
}

/**
 * @param $trans
 * @return boolean
 */
function has_trans($trans)
{
    return app('translator')->has($trans);
}
