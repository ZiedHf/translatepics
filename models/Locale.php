<?php namespace ZiedHf\TranslatePics\Models;

use Model;
use RainLab\Translate\Models\Locale as LocaleModel;
/**
 * Locale Model
 */
class Locale extends Model
{
    public static function getAllLocales() {
        return LocaleModel::get()->all();
    }
}