<?php


namespace App\Services;


use App\Models\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Throwable;

abstract class StatusService
{

    /**
     * @param string|null $type
     * @param string|null $value
     * @return Builder|Builder[]|Collection|Model|object|null
     */
    public static function get(string $type = null, string $value = null)
    {
        try {
            $query = Status::query();
            if ($type) {
                $query = $query->where('type', $type);
            }
            if ($value) {
                return $query->where('value', $value)->first();
            }
            return $query->get();
        } catch (Throwable $th) {
            return null;
        }
    }
}
