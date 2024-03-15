<?php

namespace App\Controller;

use App\Model\Product;

class ProductController
{
    
    public function addProduct(string $name, string $description, string $image): bool
    {
        $product = new Product();

        $product->setName($name);
        $product->setDescription($description);
        $product->setImage($image);
        
        try {
            $product->add();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}