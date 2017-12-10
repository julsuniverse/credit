<?php
namespace frontend\widgets;
use src\repositories\MenuRepository;
use yii\base\Widget;

class BottomMenuWidget extends Widget
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
        return $this->render('bottommenu', [
            'bottommenu' => $this->menus->getBottomMenuPages(),
            'theme' => $this->theme
        ]);
    }
}