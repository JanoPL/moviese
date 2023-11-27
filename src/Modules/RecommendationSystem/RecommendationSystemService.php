<?php

namespace App\Modules\RecommendationSystem;

use App\Modules\RecommendationSystem\Interfaces\RecommendationSystemInterface;
use App\Repository\EntertainmentProductRepository;
use Recommendations\RecommendStrategy;
use Recommendations\Strategy\Context;

class RecommendationSystemService implements RecommendationSystemInterface
{
    private $repository;
    private RecommendStrategy $recommend;
    public function __construct(
        EntertainmentProductRepository $repository
    ) {
        $this->repository = $repository;
        $this->recommend = new RecommendStrategy();
    }

    public function evenFilter(array $data)
    {
        $test = array_column($data, 'name');
        return $this->recommend->multiEvenWCriteria($data);
    }

    public function genreFilter(array $data)
    {
        $results=$this->recommend->genreCriteria($data);
        return $results;
    }

    public function multiWordsFilter(array $data)
    {
        return $this->recommend->multiWordsCriteria($data);
    }

    public function randomFilter(array $data)
    {
        return $this->recommend->randomize($data);
    }

    public function seasonNumberFilter(array $data)
    {
        return $this->recommend->SeasonNumberCriteria($data);
    }

    public function wCriteriaFilter(array $data)
    {
        return $this->recommend->multiEvenWCriteria($data);
    }
}