<?php

class VS7_AutoPosition_Model_Observer
{
    public function setPosition($observer)
    {
        $baseIncrement = 10;

        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $writeConnection = $resource->getConnection('core_write');
        $tableName = $resource->getTableName('vs7_autoposition/catalog_category_product');

        $product = $observer->getProduct();
        $productId = $product->getId();
        $categoryId = $product->getCategoryId();

        $query = "SELECT * FROM `{$tableName}` WHERE category_id=" . $categoryId . " AND product_id=" . $productId;
        $result = $readConnection->fetchAll($query);

        if(empty($result[0])) {
            $query = sprintf("INSERT INTO %s VALUES (%d,%d,%d)", $tableName, $categoryId, $productId, $baseIncrement);
        } else {
            $newPosition = $result[0]["position"]+$baseIncrement;
            $query = sprintf("UPDATE %s SET position=%d WHERE category_id=%d AND product_id=%d", $tableName, $newPosition, $categoryId, $productId);
        }

        $writeConnection->query($query);
    }
}