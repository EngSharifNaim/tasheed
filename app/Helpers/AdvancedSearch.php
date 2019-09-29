<?php
/*
    Search by Bdwey
    m.bdwey@gmail.com
*/
namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product ;


class AdvancedSearch
{
    /**
     * The builder instance.
     *
     * @var Builder
     */
    protected $builder;
    // request filters
    private $categories = [];
    private $cat = null;
    private $q = null;
    private $filters;
    // not used
    private $title = null;
    private $searchCreiteria = [];
    private $debuging = true;

    /**
     * Create a new AdvancedSearch instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $inputs = $request->all();
        $this->builder = Product::select(DB::Raw("*"))->getQuery();
        if (isset($inputs['q'])) {
            $this->filterQueryString($inputs);
            unset($inputs['q']);
        }
        $this->filters = $inputs;
    }

    /*
        search using query string
     */
    private function filterQueryString($inputs=[])
    {
        $this->searchCreiteria['q'] = $inputs['q'];
        $this->builder->orWhere(function ($query) use ($inputs) {
            $query->where('name_ar', 'like', "%{$inputs['q']}%")
            ->orWhere('name_en', 'like', "%{$inputs['q']}%")
            ->orWhere('description_ar', 'like', "%{$inputs['q']}%")
            ->orWhere('description_en', 'like', "%{$inputs['q']}%")
            ->orWhere('keywords_ar', 'like', "%{$inputs['q']}%")
            ->orWhere('keywords_en', 'like', "%{$inputs['q']}%")
            ->orWhere('details_ar', 'like', "%{$inputs['q']}%")
            ->orWhere('details_en', 'like', "%{$inputs['q']}%")
            ->orWhere('section_id', '=', "%{$inputs['q']}%")
            ->orWhere('sub_section_id', '=', "%{$inputs['q']}%");
        });
    }

    /**
     * Apply the all filters from request to the builder.
     */
    public function apply()
    {
        foreach ($this->filters as $name => $value) {
            if (!method_exists($this, $name)) {
                continue;
            }
            if ($value) {

                if (is_array($value))
                {
                    $this->$name($value);
                }
                else
                {
                    $value = trim($value);
                    if (!empty($value))
                    {
                        $this->$name($value);
                    }
                }
            } else {
                $this->$name();
            }
        }

        return $this->builder;
    }



    private function joinOrders()
    {
        // don't join me twise
        if (isset($this->searchCreiteria['joinOrders']))
        {
            return;
        }
        $this->searchCreiteria['joinOrders'] = 'yes';
        $this->builder->leftJoin('order_products', function ($join) {
            $join->on('products.id', '=', 'order_products.product_id')->whereNull('order_products.deleted_at');
        });
        $this->builder->addSelect(
            DB::raw('count(`order_products`.`id`) as ordersCount')
        );
        $this->builder->groupBy(DB::raw('`products`.`id`'));
    }


    private function price_max($price = 10000)
    {
        $this->builder->where(DB::raw('`products`.`price`'),'<=', $inputs['price_max']);
    }
    private function price_min($price = 0)
    {
        $this->builder->where(DB::raw('`products`.`price`'),'>=', $inputs['price_min']);
    }

    // private function price($priceString)
    // {
    //     $this->searchCreiteria['price'] = $priceString;
    //     if (empty($priceString) || !strpos($priceString, ',')) {
    //         return;
    //     }
    //     $priceArray = explode(',', $priceString);
    //     $this->builder->where(function ($query) use ($priceArray) {
    //         $query->where('price','>=', $priceArray)
    //         ->where('price','<=', $priceArray);
    //     });
    // }

    private function order($order)
    {
        switch ($order)
        {

            case 'old':
                $this->builder->orderBy(DB::raw('`products`.`created_at`'), 'ASC');
                $this->searchCreiteria['order'] = 'Order by date desc.';
            break;

            case 'new':
                $this->builder->orderBy(DB::raw('`products`.`created_at`'), 'DESC');
                $this->searchCreiteria['order'] = 'Order by date desc.';
            break;
            case 'low_price':
                $this->builder->orderBy(DB::raw('`products`.`price`'), 'ASC');
                $this->searchCreiteria['order'] = 'Order by price asc.';
            break;

            case 'height_price':
                $this->builder->orderBy(DB::raw('`products`.`price`'), 'DESC');
                $this->searchCreiteria['order'] = 'Order by price desc.';
            break;

            case 'most_sale':
                $this->joinOrders();
                $this->builder->orderBy(DB::raw('`ordersCount`'), 'DESC');
                $this->searchCreiteria['order'] = 'order by ratings';

            break;
            case 'lowest_sale':
                $this->joinOrders();
                $this->builder->orderBy(DB::raw('`ordersCount`'), 'ASC');
                $this->searchCreiteria['order'] = 'order by ratings';
            break;
            default:
			    break ;
              //  $this->builder->orderBy(DB::raw('`products`.`created_at`'), 'DESC');
            break;
        }
    }

    /*
        just follow current DB design 
    */
    private function section($cat = null)
    {
        $this->handleArrayValue($cat,'section_id');
    }
    private function sub_section($cat = null)
    {
        $this->handleArrayValue($cat,'sub_section_id');
    }
    private function sub2_section($cat = null)
    {
        $this->handleArrayValue($cat,'sub_sub_section_id');
    }


    private function brand($brand = null)
    {
        $this->handleArrayValue($brand,'brand_id');
    }



    private function period($dayesLimit = 30)
    {
        $this->builder->whereBetween(DB::raw('`products`.`created_at`'), array(Carbon::now()->subDays($dayesLimit), Carbon::now()));
    }

    private function handleArrayValue($val = null,$colum = null)
    {
        if ($val == null || $val == '*' || empty($colum)) {
            return $this->builder;
        }
        if (is_array($val)) {
            return $this->builder->whereIn($colum, $val);
        } elseif (strpos($val, ',')) {
            return $this->builder->whereIn($colum, explode(',', $val));
        } elseif (intval($val) == $val) {
            return $this->builder->where($colum, $val);
        }
        else
        {
            $this->searchCreiteria["ArrayValue_{$colum}"] = 'failed to query this col value';
        }
    }


    private function defaultOrders()
    {
        $this->builder->orderBy(DB::raw('`products`.`created_at`'), 'DESC');
    }

    public function builder()
    {
        $this->finalize();
        return $this->builder;
    }


    public function finalize()
    {
        $this->apply();
        $this->builder->distinct();
        $this->builder->where('products.active', '=', 'yes');
        $this->builder->where('products.quantity', '>', 0);
        $this->builder->where('products.deleted_at', '!=', null );
      //  $this->builder->where('products.price', '>', isset($request->price_min) ? $request->price_min : 100000 );
     //   $this->builder->where('products.price', '>', isset($request->price_max) ? $request->price_max : 0 );
        $this->defaultOrders();
    }

    public function getSearchCriteria()
    {
        return $this->searchCreiteria;
    }

    /*
        return the most relative title to name search page
     */
    public function getMainTitle()
    {
        if (isset($this->searchCreiteria['q'])) {
            return $this->searchCreiteria['q'];
        }
        if ($this->title) {
            return $this->title;
        }
        if (count($this->categories)) {
            return 'categories';
        }

        return 'store.Search';
    }

    /*
        use with Caution :: exposing SQL sting for development only
     */
    public function setDevStatus($status = false)
    {
        $this->debuging = $status;
    }

    public function get($paginate = 12)
    {
        $this->finalize();
        if ($this->debuging === true) {
            $this->searchCreiteria['sqlString'] = $this->builder->toSql();
        }

        return $this->builder->simplePaginate($paginate);
    }
}
