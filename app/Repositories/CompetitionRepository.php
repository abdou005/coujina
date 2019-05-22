<?php

namespace App\Repositories;

use App\Competition;

class CompetitionRepository
{
    /**
     * @var Competition
     */
    private $competition;

    /**
     * CompetitionRepository constructor.
     * @param Competition $competition
     */
    public function __construct(Competition $competition)
    {
        $this->competition = $competition;
    }

    /**
     * @param int $type
     * @param int $start
     * @param int $length
     * @param integer|null $startAt
     * @param integer|null $endAt
     * @param string|null $name
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function searchCompetitionByFilter($type, $start = 0, $length = 10, $startAt = null, $endAt = null, $name = null)
    {
        $page = $start / $length + 1;
        if (!$startAt) {
            $startAt = 0;
        }
        if (!$endAt) {
            $endAt = 9999999999;
        }
        $competitions = Competition::where(function ($query) use ($startAt, $endAt) {
            $query->where(function ($time) use ($startAt, $endAt) {
                $time->where('start_at', '<=', $startAt);
                $time->where('end_at', '>', $startAt);
                $time->where('start_at', '<', $endAt);
                $time->where('end_at', '>=', $endAt);
            })
                ->orWhere(function ($time) use ($startAt, $endAt) {
                    $time->where('end_at', '>', $startAt);
                    $time->where('end_at', '<=', $endAt);
                })
                ->orWhere(function ($time) use ($startAt, $endAt) {
                    $time->where('start_at', '>=', $startAt);
                    $time->where('start_at', '<', $endAt);
                });
        });
        if ($type !== 0){
            $competitions = $competitions->where('type', '=', $type);
        }
        if ($name){
            $competitions = $competitions->where('name', 'LIKE', '%'.$name.'%');
        }
        $competitions = $competitions->paginate($length, ['*'], $start, $page);
        return $competitions;
    }


    /**
     * @param string $name
     * @param string $type
     * @param integer $startAt
     * @param integer $endAt
     * @param string $image
     * @param string|null $address
     * @param string|null $desc
     * @return Competition $competition
     */
    public static function createCompetition($name, $type, $startAt, $endAt, $image, $address = null, $desc = null)
    {
        $competition = new Competition();
        $competition->name = $name;
        $competition->type = $type;
        $competition->start_at = $startAt;
        $competition->end_at = $endAt;
        $competition->image = $image;
        $competition->address = $address;
        $competition->desc = $desc;
        $competition->save();
        return $competition;
    }


    /**
     * @param string $name
     * @param string $type
     * @param string $startAt
     * @param string $endAt
     * @param string $image
     * @param string|null $address
     * @param string|null $desc
     * @return Competition $competition
     */
    public function updateCompetition($name, $type, $startAt, $endAt, $image, $address = null, $desc = null): Competition
    {
        $this->competition->name = $name;
        $this->competition->type = $type;
        $this->competition->start_at = $startAt;
        $this->competition->end_at = $endAt;
        $this->competition->image = $image;
        $this->competition->address = $address;
        $this->competition->desc = $desc;
        $this->competition->save();
        return $this->competition;
    }
}