<?php namespace ZiedHf\TranslatePics\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use System\Classes\PluginManager;
use ZiedHf\TranslatePics\Plugin;

class CreateLocalesTable extends Migration
{
    const TABLE_TRANSLATE = 'rainlab_translate_locales';
    const TABLE_EXTENDED = 'RainLab.Translate';

    public function up()
    {
        if (PluginManager::instance()->hasPlugin(self::TABLE_EXTENDED)) {
            $this->createColumn(self::TABLE_TRANSLATE, Plugin::PICTURE_COLUMN);
        }
    }

    public function down()
    {
        if (PluginManager::instance()->hasPlugin(self::TABLE_EXTENDED)) {
            $this->dropColumn(self::TABLE_TRANSLATE, Plugin::PICTURE_COLUMN);
        }
    }

    private function createColumn($table, $field) {
        if (!Schema::hasColumn($table, $field)) {
            Schema::table($table, function ($table) use ($field) {
                $table->string($field)->nullable();
            });
        }
    }

    /**
     * @param string $column
     */
    private function dropColumn(string $table, string $column)
    {
        if (Schema::hasColumn($table, $column)) {
            Schema::table($table, function ($table) use ($column) {
                $table->dropColumn($column);
            });
        }
    }
}
