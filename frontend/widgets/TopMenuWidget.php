<?php
namespace frontend\widgets;
use src\repositories\MenuRepository;
use yii\base\Widget;

class TopMenuWidget extends Widget
{
    private $menus;

    public function __construct(MenuRepository $menus, $config = [])
    {
        $this->menus = $menus;
        parent::__construct($config);

    }
    public function run(): string
    {
        return $this->render('topmenu', [
            'menu' => $this->menus->getTopMenuPages(),
        ]);
    }
}