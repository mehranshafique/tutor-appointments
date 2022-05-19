<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyPriceRequest;
use App\Http\Requests\StorePriceRequest;
use App\Http\Requests\UpdatePriceRequest;
use App\Permission;
use App\Price;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class PriceController extends Controller
{
  public function index()
  {
      abort_if(Gate::denies('price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      $prices = Price::all();

      return view('admin.price.index', compact('prices'));
  }

  public function create()
  {
      abort_if(Gate::denies('price_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      return view('admin.price.create');
  }

  public function store(StorePriceRequest $request)
  {
      $price = Price::create($request->all());

      return redirect()->route('admin.prices.index');
  }

  public function edit(Price $price)
  {
      abort_if(Gate::denies('price_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      return view('admin.price.edit', compact('price'));
  }

  public function update(UpdatePriceRequest $request, Price $price)
  {
      $price->update($request->all());

      return redirect()->route('admin.prices.index');
  }

  public function show(Price $price)
  {
      abort_if(Gate::denies('price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
      return view('admin.price.show', compact('price'));
  }

  public function destroy(Price $price)
  {
      abort_if(Gate::denies('price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      $price->delete();

      return back();
  }

  public function massDestroy(MassDestroyPriceRequest $request)
  {
      Price::whereIn('id', request('ids'))->delete();

      return response(null, Response::HTTP_NO_CONTENT);
  }
}
