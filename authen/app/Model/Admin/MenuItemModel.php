<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MenuItemModel extends Model
{
    //
    public $table = 'menu_items';

    public static function OutputLevelCategories($input_category,&$output_category,$parent_id = 0, $level = 1){
        if (count($input_category) > 0) {
            foreach ($input_category as $category){
                $category = (array) $category;
                if ($category['parent_id'] == $parent_id){
                    $category['level'] = $level;
                    $output_category[] = $category;
                    $new_parent_id = $category['id'];
                    $new_level = $level + 1;
                    self::OutputLevelCategories($input_category,$output_category,$new_parent_id,$new_level);
                }
            }
        }
    }
    /*
    * Để loại bỏ trường hợp menu item chọn chính nó, chọn con, cháu làm cha thì phải ngắt hết các TH đó đi
    * TH mà id trong mảng bằng với id của
    */
    public static function OutputLevelCategoriesExcept($input_category,&$output_category,$parent_id = 0, $level = 1,$except){
        if (count($input_category) > 0) {
            foreach ($input_category as $category){
                if ($category['parent_id'] == $parent_id){
                    $category['level'] = $level;
                    if($category['id'] != $except){
                        $output_category[] = (array)$category;
                    }
                    if($category['id'] != $except){
                        $new_parent_id = $category['id'];
                        $new_level = $level + 1;
                        self::OutputLevelCategoriesExcept($input_category,$output_category,$new_parent_id,$new_level,$except);
                    }
                }
            }
        }
    }

    public static function getMenuItemRecusiveExcept($except) {
        $source = MenuItemModel::all()->toArray();
        $result = array();
        self::OutputLevelCategoriesExcept($source,$result,0,1,$except);
        return $result;
    }

    public static function getMenuItemRecursive(){ // lấy các menu tương ứng
        $source = MenuItemModel::all()->toArray();
        $result = array();
        self::OutputLevelCategories($source,$result);
        return $result;
    }

    public static function getTypeOfMenuItem(){

        $types = array();
        $types[1] = 'Shop category';
        $types[2] = 'Shop product';
        $types[3] = 'Content category';
        $types[4] = 'Content post';
        $types[5] = 'Content page';
        $types[6] = 'Content tag';
        $types[7] = 'Custom link';
        return $types;
    }

    public static function getMenuItemsByHeader(){
        $menu_header = DB::table('menus')->where('location', 1)->first();
        if(isset($menu_header->id)){
            $source = DB::table('menu_items')->where('menu_id', $menu_header->id)->orderBy('sort','ASC')->get()->toArray();

            $result = array();
            self::OutputLevelCategories($source,$result);

        }
        else {
            $result = array();
        }
        return $result;
    }

    public static function getMenuItemsByFooter1(){
        $menu_header = DB::table('menus')->where('location', 2)->first();
        if(isset($menu_header->id)){
            $menu_items_header = DB::table('menu_items')->where('menu_id', $menu_header->id)->get();
        }
        else {
            $menu_items_header = array();
        }

        return $menu_items_header;
    }

    public static function getMenuItemsByFooter2(){
        $menu_header = DB::table('menus')->where('location', 3)->first();
        if(isset($menu_header->id)){
            $menu_items_header = DB::table('menu_items')->where('menu_id', $menu_header->id)->get();
        }
        else {
            $menu_items_header = array();
        }
        return $menu_items_header;
    }

    public static function getMenuItemsByFooter3(){
        $menu_header = DB::table('menus')->where('location', 4)->first();
        if(isset($menu_header->id)){
            $menu_items_header = DB::table('menu_items')->where('menu_id', $menu_header->id)->get();
        }
        else {
            $menu_items_header = array();
        }
        return $menu_items_header;
    }

    public static function buildMenuHTML($input_category,&$html,$parent_id = 0, $level = 1){
        if (count($input_category) > 0) {
            if($level == 1){
                $html .= "<ul class='nav navbar-nav '>";
            }else if($level == 2){
                $html .= "<ul class=\"dropdown-menu multi\">
                                <div class=\"row\">
                                    <div class=\"col-sm-4\">
                                        <ul class=\"multi-column-dropdown\">";
            }else{
                // Chỉ hiện thị 2 cấp nên từ cấp thứ 3 sẽ không hiển thị nữa
            }
            foreach ($input_category as $category){
                if ($category['parent_id'] == $parent_id){
                    $category['level'] = $level;
                    if ($category['type'] == 7){
                        $menu_link = $category['link'];
                    }else {
                        $menu_link = url($category['link']);
                    }
                    if($level == 1){
                        $li_class = (isset($category['total']) && $category['total'] > 0) ? 'dropdown' : '';
                        $li_icon = (isset($category['total']) && $category['total'] > 0) ? '<b class="caret"></b>' : '';

                        $html .= "<li class='".$li_class."'><a href='".$menu_link."' target='_blank' class=\"hyper\"><span>";
                        $html .= $category['name'].$li_icon;
                    } elseif ($level == 2){
                        $html .= "<li><a href='".$menu_link."' target='_blank'><i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>";
                        $html .= $category['name'];
                    }else{

                    }


                    $new_parent_id = $category['id'];
                    $new_level = $level + 1;
                    self::BuildMenuHTML($input_category,$html,$new_parent_id,$new_level);

                    if($level == 1){
                        $html .= "</span></a></li>";
                    } elseif ($level == 2){
                        $html .= "</a></li>";
                    }else{

                    }
                }
            }
            if($level == 1){
                $html .= "</ul>";
            }else if($level == 2){
                $html .= "</ul>
                    </div>
                    <div class=\"clearfix\"></div>
                </div>
            </ul>";
            }else{
                // Chỉ hiện thị 2 cấp nên từ cấp thứ 3 sẽ không hiển thị nữa
            }
        } 
    }
    public static function getMenu($source) {
        $html_menu = '';
        self::BuildMenuHTML($source,$html_menu);
        return $html_menu;
    }
}
