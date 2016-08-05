<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 04.08.16
 * Time: 23:13
 */

namespace FinanceApp\Repository;


class CategoriesRepository extends AbstractRepository
{
    public function getCategories()
    {
        $categories = $this->dbConnection->fetchAll(
            'SELECT * FROM category ORDER BY id'
        );

        return $categories;
    }

    public function getCategoryByName($name)
    {
        $category = $this->dbConnection->fetchArray(
            'SELECT id FROM category WHERE name = ?', [$name]
        );

        return $category[0];
    }
}