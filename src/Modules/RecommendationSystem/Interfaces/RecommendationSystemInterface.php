<?php

namespace App\Modules\RecommendationSystem\Interfaces;

interface RecommendationSystemInterface
{
    public function evenFilter(array $data);
    public function genreFilter(array $data);
    public function multiWordsFilter(array $data);
    public function randomFilter(array $data);
    public function seasonNumberFilter(array $data);
    public function wCriteriaFilter(array $data);
}