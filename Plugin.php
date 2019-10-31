<?php namespace ZiedHf\TranslatePics;

use Backend;
use System\Classes\PluginBase;
use RainLab\Translate\Models\Locale as LocaleModel;
use RainLab\Translate\Controllers\Locales as LocalesController;

/**
 * translatePics Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
        'RainLab.Translate'
    ];

    const PICTURE_COLUMN = 'translatepics_picture';
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'translatePics',
            'description' => 'No description provided yet...',
            'author'      => 'ZiedHf',
            'icon'        => 'icon-language'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        $this->extendController();
        $this->extendModel();
    }

    /**
     * Extend Categories controller
     */
    private function extendController()
    {
        $fieldName = self::PICTURE_COLUMN;
        $fieldsToAdd = [
            'label' => 'Icon',
            'type' => 'mediafinder',
            'mode' => 'image',
            'comment' => 'Best resolution : 24x16'
        ];

        LocalesController::extendFormFields(function ($form, $model) use ($fieldName, $fieldsToAdd) {
            if (!$model instanceof LocaleModel) return;

            $form->addFields([$fieldName => $fieldsToAdd]);
        });
    }

    /**
     * Extend Category model
     */
    private function extendModel()
    {
        LocaleModel::extend(function ($model) {
            $model->addDynamicMethod('getTranslatePicForLocale', function() use ($model) {
                return $model->{self::PICTURE_COLUMN};
            });
        });
    }
    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'ZiedHf\TranslatePics\Components\LocalePickerPics' => 'LocalePickerPics',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'ziedhf.translatepics.some_permission' => [
                'tab' => 'translatePics',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'translatepics' => [
                'label'       => 'translatePics',
                'url'         => Backend::url('ziedhf/translatepics/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['ziedhf.translatepics.*'],
                'order'       => 500,
            ],
        ];
    }
}
