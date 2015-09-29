<?php

namespace Home\TaskBundle\Entity;

use Doctrine\ORM\EntityRepository;
//use Proxies\__CG__\Home\TaskBundle\Entity\Category;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
    public function getCategoryToCount()
    {
        // Получение списка категорий из базы и количество записей по каждой категории
        // из таблицы Task
        //$Query = $this->getEntityManager()->createQuery(Q)
        /// todo написать запрос который будет выдавать для каждой категории количество записей в таблице Task
        /// SELECT c.id, c.Category, count(t.id) FROM task as t JOIN category as c  ON t.Category_id = c.id GROUP BY t.Category_id;
        $Query = $this->getEntityManager()->createQuery('SELECT c.id as id_cat, c.Category as category, count(t.id) as CountCategory FROM HomeTaskBundle:Task as t JOIN HomeTaskBundle:Category as c  where t.Category = c.id GROUP BY c.id');
        $Result=$Query->getResult();
        return $Result;
    }
}
