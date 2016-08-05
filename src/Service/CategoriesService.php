<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 04.08.16
 * Time: 23:09
 */

namespace FinanceApp\Service;


use FinanceApp\Repository\CategoriesRepository;

class CategoriesService
{
    protected $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function getCategories()
    {
        return $this->categoriesRepository->getCategories();
    }
}