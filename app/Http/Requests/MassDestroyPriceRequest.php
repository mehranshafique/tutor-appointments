<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Gate;
class MassDestroyPriceRequest extends FormRequest
{
  public function authorize()
  {
      abort_if(Gate::denies('price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      return true;
  }

  public function rules()
  {
      return [
          'ids'   => 'required|array',
          'ids.*' => 'exists:prices,id',
      ];
  }
}
