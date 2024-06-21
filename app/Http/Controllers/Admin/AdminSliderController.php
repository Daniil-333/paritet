<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSliderController extends Controller
{
    public function index()
    {
        $slides = (new Slider())->all();
        return view('admin.slider')->with([
            'slides' => $slides,
        ]);
    }


    public function update(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->except('_token');
            $idx = $data['id'];
            $handledSlides = [];
            $slides = Slider::all()->keyBy('id')->all();

            //Потенциальные слайды на удаление
            $removableSlides = $slides;

            //Собираем массив Слайдов
            foreach ($data['id'] as $k => $slide) {
                //Если была загрузка фото кладём объект в массив
                if(array_key_exists('slide', $data)) {
                    if(array_key_exists($k, $data['slide'])) {
                        $handledSlides[$idx[$k]]['name'] = $data['slide'][$k];
                    }
                }
                $handledSlides[$idx[$k]]['id'] = $idx[$k];
                $handledSlides[$idx[$k]]['link'] = $data['link'][$k];
                $handledSlides[$idx[$k]]['alt'] = $data['alt'][$k];
                $handledSlides[$idx[$k]]['position'] = $data['position'][$k];
            }

            if(count($handledSlides) > 0) {
                //Проверяем, есть ли в массиве Слайдов из БД те, что пришли с формы
                foreach ($handledSlides as $kSlide => $handledSlide) {
                    //Если есть, актуализируем инфо с БД по необходимости
                    if(array_key_exists($kSlide, $slides)) {
                        unset($removableSlides[$kSlide]);
                        $slideNew = Slider::find($kSlide);
                        $urlOld = null;
                        //Проверяем, загружалось ли фото?!
                        if(array_key_exists('name', $handledSlide)) {
                            //Если не совпадает, то старое надо удалить, а новое добавить!
                            if($slides[$kSlide]->name != $handledSlide['name']) {
                                $pathFile = explode('/', $slides[$kSlide]->name);
                                Storage::delete('/public/slider/' . array_pop($pathFile));
                                $pathOld = Storage::putFile('/public/slider',  $handledSlide['name']);
                                $urlOld = Storage::url($pathOld);
                            }
                        }

                        //Обновляем инфу в БД
                        ($urlOld) ? $slideNew->name = $urlOld : '';

                        $slideNew->alt = $handledSlide['alt'];
                        $slideNew->link = $handledSlide['link'];
                        $slideNew->position = $handledSlide['position'];
                        $slideNew->save();
                    }

                    else {
                        $path = Storage::putFile('/public/slider', $handledSlide['name']);
                        $url = Storage::url($path);

                        $newSlide = new Slider();
                        $newSlide->name = $url;
                        $newSlide->link = $handledSlide['link'];
                        $newSlide->alt = $handledSlide['alt'];
                        $newSlide->position = $handledSlide['position'];
                        $newSlide->save();


                    }
                }

                //Удаляем слайды, не пришедшие с формы
                if(count($removableSlides) > 0) {
                    foreach ($removableSlides as $removableSlide) {
                        $this->deleteFile($removableSlide->name);
                        $removableSlide->delete();
                    }
                }
            }
        }

        return view('admin.slider')->with('slides', Slider::all());
    }

    public function deleteFile($name)
    {
        $pathFile = explode('/', $name);
        Storage::delete('/public/slider/' . array_pop($pathFile));
    }
}
