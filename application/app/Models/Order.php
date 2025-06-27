<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\Services;
use App\Models\ApiProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public function service()
    {
        return $this->belongsTo(Services::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function provider()
	{
		return $this->belongsTo(ApiProvider::class, 'api_provider_id', 'id');
	}

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function statusBadge($status){
        $html = '';
        if($this->status == 0){
            $html = '<span class="badge badge--warning">'.trans('Pending').'</span>';
        }elseif($this->status == 1){
            $html = '<span class="badge badge--primary">'.trans('Processing').'</span>';
        }elseif($this->status == 2){
            $html = '<span class="badge badge--success">'.trans('Completed').'</span>';
        }elseif($this->status == 3){
            $html = '<span class="badge badge--danger">'.trans('Cancelled').'</span>';
        }elseif($this->status == 4){
            $html = '<span class="badge badge--warning">'.trans('Refunded').'</span>';
        }

        return $html;
    }
}
