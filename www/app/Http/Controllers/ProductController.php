<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Enum\LangController;
use App\Models\Debtors;
use App\Models\Entrance;
use App\Models\EntranceStore;
use App\Models\Order;
use App\Models\Type;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use function Doctrine\Common\Cache\Psr6\get;

class ProductController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE          = 'product.create';

    /** @var string  */
    const ROUTE_CREATE_TYPE     = 'product.createType';

    /** @var string  */
    const ROUTE_REMAINS         = 'product.remains';

    /** @var string  */
    const ROUTE_DEBTORS         = 'product.debtors';

    /** @var string  */
    const ROUTE_SALES           = 'product.sales';

    /** @var string  */
    const ROUTE_ENTRANCE        = 'product.entrance';

    /** @var string  */
    const ROUTE_ENTRANCE_CHECK  = 'product.entranceCheck';

    /**
     * Создание продукта
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $arTypes = [];

        $obTypes = (new Type())->all();
        foreach ($obTypes as $value) {

            if ($_REQUEST['lang'] == 'ru') {
                $name = $value['nameRu'];
            } elseif ($_REQUEST['lang'] == 'eng') {
                $name = $value['nameEng'];
            } else {
                $name = $value['nameGe'];
            }

            $arTypes[] = [
                'id'        => $value['id'],
                'name'      => $name,
            ];
        }

        return view('product.create', [ 'arTypes' => $arTypes]);
    }

    /**
     * Создание типа продукта (категории)
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function createType()
    {
        $arTypes = [];

        $obTypes = (new Type())->all();
        foreach ($obTypes as $value) {

            if ($_REQUEST['lang'] == 'ru') {
                $name = $value['nameRu'];
            } elseif ($_REQUEST['lang'] == 'eng') {
                $name = $value['nameEng'];
            } else {
                $name = $value['nameGe'];
            }

            $arTypes[] = [
                'id'        => $value['id'],
                'img'       => $value['img'],
                'name'      => $name,
            ];
        }

        return view('product.create-type', [ 'arTypes' => $arTypes]);
    }

    /**
     * Остатки
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function remains(Request $request)
    {
        $arTypes = [];

        $obTypes = (new Type())->all();
        foreach ($obTypes as $value) {
            $arTypes[] = [
                'id'    => $value['id'],
                'type'  => $value['type'],
            ];
        }

        $iCount = (new Product)
            ->when($request->get('type'), function (Builder $query) use ($request) {
                return $query->where('type', (string) $request->get('type'));
            })->get()->count();

        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        $arProducts = (new Product)
            ->when($request->get('type'), function (Builder $query) use ($request) {
                return $query->where('type', (string) $request->get('type'));
            })
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->orderByDesc('id')
            ->get()
            ->all()
        ;

        return view('product.remains', [
            'arTypes'       => $arTypes,
            'arProducts'    => $arProducts,
                'pagination'    => [
                    'total'       => $iCount,
                    'limit'       => self::TABLE_ROWS_LIMIT,
                    'page_count'  => ceil($iCount / self::TABLE_ROWS_LIMIT),
                    'page'        => $iPage,
                ]
            ]
        );
    }

    /**
     * Должники
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function debtors(Request $request)
    {
        $status = 'გადასახდელი';
        if ($request->get('status')  == 'გადახდილი') {
            $status = 'გადახდილი';
        }
        $dateTo = date('Y-m-d H:i:s');
        $dateFrom = $dateTo;

        if (!empty((new Debtors())->get('created_at')->first())) {
            $dateFrom = (new Debtors())->get('created_at')->first()->created_at->format('Y-m-d');
        }

        if (!empty($request->get('from'))) {
            $dateFrom = $request->get('from');
        }
        if (!empty($request->get('to'))) {
            $dateTo = date("Y-m-d", strtotime($request->get('to').'+ 1 days'));
        }

        $iCount = (new Debtors())->when($request->get('debtorName'), function (Builder $query) use ($request) {
            return $query->where('name', (string) $request->get('debtorName'));
        })
            ->where('status', $status)
            ->where('created_at' , '>=',  $dateFrom)
            ->where('created_at' , '<=',  $dateTo)
            ->get()->count();
        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        $obDebtors = (new Debtors())
            ->when($request->get('debtorName'), function (Builder $query) use ($request) {
                return $query->where('name', (string) $request->get('debtorName'));
            })
            ->where('status', $status)
            ->where('created_at' , '>=',  $dateFrom)
            ->where('created_at' , '<=',  $dateTo)
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->orderByDesc('created_at')
            ->get()
            ->all()
        ;

        $arName = [];
        $obDebtorsName = (new Debtors())->get('name')->all();
        foreach ($obDebtorsName as $value) {
            $arName[] = $value->name;
        }
        $arName = array_unique($arName);

        return view(
            'product.debtors',
            [
                'arDebtors' => $obDebtors,
                'arName' => $arName,
                'pagination'    => [
                    'total'       => $iCount,
                    'limit'       => self::TABLE_ROWS_LIMIT,
                    'page_count'  => ceil($iCount / self::TABLE_ROWS_LIMIT),
                    'page'        => $iPage,
                ]
            ]
        );
    }

    /**
     * Продажи
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function sales()
    {
        return view('product.sales');
    }

    /**
     * Поступление
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function entrance()
    {
        $arEntrance = (new EntranceStore())
            ->orderBy('updated_at', 'desc')
            ->get()
        ;

        return view('product.entrance', [
                'arEntrance'    => $arEntrance,
            ]
        );
    }

    /**
     * ПРосмотр поступлений
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function entranceCheck(Request $request)
    {
        $dateTo = date('Y-m-d H:i:s');
        $dateFrom = $dateTo;

        if (!empty((new Entrance())->get('created_at')->first())) {
            $dateFrom = (new Entrance())->get('created_at')->first()->created_at->format('Y-m-d');
        }

        if (!empty($request->get('from'))) {
            $dateFrom = $request->get('from');
        }
        if (!empty($request->get('to'))) {
            $dateTo = date("Y-m-d", strtotime($request->get('to').'+ 1 days'));
        }

        $iCount = (new Entrance())->when($request->get('creator'), function (Builder $query) use ($request) {
            return $query->where('creator', (string) $request->get('creator'));
        })
            ->where('created_at' , '>=',  $dateFrom)
            ->where('created_at' , '<=',  $dateTo)
            ->get()->count();
        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }


        $arEntrance = (new Entrance())
            ->where('created_at' , '>=',  $dateFrom)
            ->where('created_at' , '<=',  $dateTo)
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->orderByDesc('created_at')
            ->get()
            ->all()
        ;

        return view('product.entranceCheck',
            [
                'arEntrance'    => $arEntrance,
                'pagination'    => [
                    'total'       => $iCount,
                    'limit'       => self::TABLE_ROWS_LIMIT,
                    'page_count'  => ceil($iCount / self::TABLE_ROWS_LIMIT),
                    'page'        => $iPage,
                ]
            ]
        );
    }
}
