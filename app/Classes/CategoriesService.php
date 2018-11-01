<?php
/**
 * Created by PhpStorm.
 * User: xyz
 * Date: 2/26/2018
 * Time: 10:33 AM
 */

namespace App\Classes;


class CategoriesService
{
    public function saveCategories($categories, $name, $desc, $m_title, $meta_desc, $meta_keyword, $meta_tags)
    {
        if (isset($categories->name)) {
            if ($categories->name != $name) {
                $categories->slug = $categories->getSlugForCustom($categories->name);
            }
        } else {
            $categories->slug = $categories->getSlugForCustom($name);
        }
        $categories->name = $name;
        $categories->desc = $desc;
        $categories->m_title = $m_title;
        $categories->m_desc = $meta_desc;
        $categories->m_keywords = $meta_keyword;
        $categories->m_tag = $meta_tags;
        return $categories;
    }

    public function saveSubCategories($subcategories, $name, $catId, $desc, $commission, $commissionType, $m_title, $meta_desc, $meta_keyword, $meta_tags)
    {
        if (isset($subcategories->name)) {
            if ($subcategories->name != $name) {
                $subcategories->slug = $subcategories->getSlugForCustom($subcategories->name);
            }
        } else {
            $subcategories->slug = $subcategories->getSlugForCustom($name);
        }
        $subcategories->name = $name;
        $subcategories->category_id = $catId;
        $subcategories->desc = $desc;
        if($commission){
            $subcategories->commission = $commission;
        }
        if ($commissionType) {
            $subcategories->commission_type = $commissionType;
        }
        $subcategories->m_title = $m_title;
        $subcategories->m_desc = $meta_desc;
        $subcategories->m_keywords = $meta_keyword;
        $subcategories->m_tag = $meta_tags;
        $subcategories->save();
        return $subcategories;
    }

    //by ishwar
    public function saveSubCategories2($subcategories, $name, $catId, $desc, $commission, $commissionType, $m_title, $meta_desc, $meta_keyword, $meta_tags)
    {
        if (isset($subcategories->name)) {
            if ($subcategories->name != $name) {
                $subcategories->slug = $subcategories->getSlugForCustom($subcategories->name);
            }
        } else {
            $subcategories->slug = $subcategories->getSlugForCustom($name);
        }
        $subcategories->name = $name;
        $subcategories->subcategory_id = $catId;
        $subcategories->desc = $desc;
        if($commission){
            $subcategories->commission = $commission;
        }
        if ($commissionType) {
            $subcategories->commission_type = $commissionType;
        }
        $subcategories->m_title = $m_title;
        $subcategories->m_desc = $meta_desc;
        $subcategories->m_keywords = $meta_keyword;
        $subcategories->m_tag = $meta_tags;
        return $subcategories;
    }
}