<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BrandPackageOrder extends Model
{
    use HasFactory;

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
