<?php
/**
 * Created by PhpStorm.
 * User: WeiYalin
 * Date: 2019/1/16
 * Time: 15:58
 */

namespace App\Http\Controllers\Admin;

use App\Model\Menu;

class MenuController{
    public function getMenu() {
        $menus = $this->formatMenu(Menu::getFormatMenu());
        return responseToJson(0, 'success', $menus);
    }
    private function formatMenu($menus) {
        $data = [];
        foreach ($menus as $v) {
            if ($v->depth == 1) {
                $v->children = [];
                $data[$v->id] = $v;
            }
        }
        foreach ($menus as $v) {
            if ($v->depth == 2) {
                $data[$v->pid]->children[] = $v;
            }
        }
        return array_values($data);
    }
}