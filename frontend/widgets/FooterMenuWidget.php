<?php
namespace frontend\widgets;
use src\repositories\MenuRepository;
use yii\base\Widget;

class FooterMenuWidget extends Widget
{
    private $menus;
    public $theme;

    public function __construct(MenuRepository $menus, $config = [])
    {
        $this->menus = $menus;
        parent::__construct($config);

    }
    public function run(): string
    {
        return $this->render('footermenu', [
            'footermenu' => $this->menus->getFooterMenuPages(),
            'theme' => $this->theme
        ]);
    }
}