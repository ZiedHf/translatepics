<?php namespace ZiedHf\TranslatePics\Components;
use Log;
use Cms\Classes\ComponentBase;
use RainLab\Translate\Components\LocalePicker as ComponentLocalePicker;
use ZiedHf\TranslatePics\Models\Locale as ModelLocale;
// use ZiedHf\TranslatePics\Plugin;
class LocalePickerPics extends ComponentLocalePicker
{
    public function init()
    {
        parent::init();
        $this->addCss('/plugins/ziedhf/translatepics/assets/css/main.css');
        $this->addJs('/plugins/ziedhf/translatepics/assets/js/jquery.ddslick.min.js');
        $this->addJs('/plugins/ziedhf/translatepics/assets/js/translatePics.js');
    }

    public function componentDetails()
    {
        return [
            'name'        => 'LocalePickerPics Component',
            'description' => 'Show a dropdown with language pictures'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun() {
        // ComponentLocalePicker::onRun();
        // $this->addJs('/plugins/ziedhf/translatepics/assets/js/jquery.ddslick.min.js');
        // $this->addJs('/plugins/ziedhf/translatepics/assets/js/translatePics.js');
        
        // $this->addCss('/plugins/dizoo/slider/assets/css/custom-slider.css');
        $this->page['localesWithPics'] = ModelLocale::getAllLocales();
    }
}
