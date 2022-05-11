<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DictData\CreateRequest;
use App\Http\Requests\Admin\DictData\GetListRequest;
use App\Http\Requests\Admin\DictData\IdRequest;
use App\Http\Requests\Admin\DictData\UpdateRequest;
use App\Http\Response\ApiCode;
use App\Models\DictData;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Symfony\Component\HttpFoundation\Response;

class DictDataController extends Controller
{
    /**
     * 列表
     *
     * @param GetListRequest $request
     * @return Response
     */
    public function list(GetListRequest $request): Response
    {
        $validated = $request->validated();
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData(DictData::list($validated))
            ->withMessage(__('message.common.search.success'))
            ->build();
    }

    /**
     * 详情
     *
     * @param IdRequest $request
     * @return Response
     */
    public function info(IdRequest $request): Response
    {
        $validated = $request->validated();
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData(DictData::find($validated['id']))
            ->withMessage(__('message.common.search.success'))
            ->build();
    }

    /**
     * 创建
     *
     * @param CreateRequest $request
     * @return Response
     */
    public function create(CreateRequest $request): Response
    {
        $validated = $request->validated();
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData(DictData::create($validated))
            ->withMessage(__('message.common.create.success'))
            ->build();
    }

    /**
     * 更新
     *
     * @param UpdateRequest $request
     * @return Response
     */
    public function update(UpdateRequest $request): Response
    {
        $validated = $request->validated();
        $model = DictData::find($validated['id']);
        $model->update($validated);
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData($model)
            ->withMessage(__('message.common.update.success'))
            ->build();
    }

    /**
     * 删除
     *
     * @param IdRequest $request
     * @return Response
     */
    public function delete(IdRequest $request): Response
    {
        $validated = $request->validated();
        DictData::whereId($validated['id'])->delete();
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withMessage(__('message.common.delete.success'))
            ->build();
    }

    public function listClass(): Response
    {
        return ResponseBuilder::asSuccess(ApiCode::HTTP_OK)
            ->withHttpCode(ApiCode::HTTP_OK)
            ->withData([
                'list' => [
                    ['name' => '默认', 'value' => ''],
                    ['name' => '主要', 'value' => 'primary'],
                    ['name' => '成功', 'value' => 'success'],
                    ['name' => '信息', 'value' => 'info'],
                    ['name' => '警告', 'value' => 'warning'],
                    ['name' => '危险', 'value' => 'danger'],
                ]
            ])
            ->withMessage(__('message.common.search.success'))
            ->build();
    }
}
