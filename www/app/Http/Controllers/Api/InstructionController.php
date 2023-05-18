<?php
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Instruction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class InstructionController
 * @package App\Http\Controllers\Api
 */
class InstructionController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE = 'api.instruction.create';

    /** @var string  */
    const ROUTE_UPDATE = 'api.instruction.update';

    /** @var string */
    const ROUTE_STATUS = 'api.instruction.status';

    /**
     * Add new instruction
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $obInstruction = new Instruction();

        if (!empty($request->file())){
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obInstruction->main_img = $filePath;
        }

        $obInstruction->user_id           = (int) auth()->user()->getAuthIdentifier();
        $obInstruction->name              = $request->get('name');
        $obInstruction->link              = $request->get('link');
        $obInstruction->price             = (float) str_replace(',', '.', $request->get('price'));
        $obInstruction->short_description = $request->get('short_description');
        $obInstruction->content           = $request->get('content');
        $obInstruction->status            = Instruction::STATUS_SALE;
        $obInstruction->save();

        return redirect()->route(\App\Http\Controllers\InstructionController::ROUTE_LIST);
    }

    /**
     * Change instruction status
     *
     * @param Request $request
     * @return []
     */
    public function status($id, $status)
    {
        $obInstruction = (new Instruction())
            ->when(!Auth::user()->isAdmin(), function (Builder $query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->where('id', $id)
            ->first()
        ;

        if (!$obInstruction) {
            abort(404);
        }

        $obInstruction->status = $status;
        $obInstruction->save();

        return ['instruction' => $obInstruction];
    }

    /**
     * Update instruction
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $obInstruction = (new Instruction())
            ->when(!Auth::user()->isAdmin(), function (Builder $query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->where('id', (int) $request->get('instructionId'))
            ->first()
        ;

        $fileMainImg = storage_path('app/public/' . $obInstruction['main_img']);

        if (!empty($request->file('main_img'))){
            if (file_exists($fileMainImg)) {
                if (!empty($obInstruction['main_img'])) {
                    unlink(storage_path('app/public/' . $obInstruction['main_img']));
                }
            }
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obInstruction->main_img = $filePath;
        }

        $obInstruction->name              = $request->get('name');
        $obInstruction->link              = $request->get('link');
        $obInstruction->price             = (float) str_replace(',', '.', $request->get('price'));
        $obInstruction->short_description = $request->get('short_description');
        $obInstruction->content           = $request->get('content');

        if (empty($request->get('status'))) {
            $obInstruction->status = $obInstruction['status'];
        } else {
            $obInstruction->status = $request->get('status');
        }

        $obInstruction->update();

        return back();
    }
}
