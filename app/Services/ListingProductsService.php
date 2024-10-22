<?php

namespace App\Services;

use App\Models\Product;

class ListingProductsService
{
    protected $query;

    protected $data;

    public function getProductsWithPagination($data)
    {
        $this->startQuery($data);

        /**
         * I tried many solutions for cashing items, but each solution will not affect here (With Ecommerce Apps)
         * As we expect special memory usage, So the best solution here to use "Elasticsearch"
         * 1- We will avoid full memory because cashing. (Its very important because after the full size of memory the apps will crash)
         * 2- We will get a good response for cashing items as we expect
         * 3- We will avoid making many codes for handling this point.
         */
        return $this->filterByName()
            ->filterByPriceRange()
            ->filterByCategory()
            ->getQuery()
            ->cursorPaginate($data['per_page'] ?? 20, ['*'], 'cursor', $data['cursor'] ?? null);
    }

    public function startQuery($data): void
    {
        $this->query = Product::with('category');
        $this->data = $data;
    }

    public function getQuery()
    {
        return $this->query;
    }

    private function filterByName(): static
    {
        if (!empty($this->data['name'])) {
            $this->query->whereRaw('name LIKE ?', ['%' . $this->data['name'] . '%']);
        }

        return $this;
    }

    private function filterByPriceRange(): static
    {
        if (!empty($this->data['min_price']) || !empty($this->data['max_price'])) {
            $minPrice = $this->data['min_price'] ?? null;
            $maxPrice = $this->data['max_price'] ?? null;

            if ($minPrice && $maxPrice) {
                $this->query->whereBetween('price', [$minPrice, $maxPrice]);
            } elseif ($minPrice) {
                $this->query->where('price', '>=', $minPrice);
            } elseif ($maxPrice) {
                $this->query->where('price', '<=', $maxPrice);
            }
        }

        return $this;
    }

    private function filterByCategory(): static
    {
        if (!empty($this->data['category_id'])) {
            $this->query->where('category_id', $this->data['category_id']);
        }

        return $this;
    }
}
