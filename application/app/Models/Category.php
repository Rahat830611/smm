<?php

namespace App\Models;

use App\Models\Services;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public function services()
    {
        return $this->hasMany(Services::class);
    }

    public function statusBadge($status){
        $html = '';
        if($this->status == 1){
            $html = '<span class="badge badge--success">'.trans('Active').'</span>';
        }else{
            $html = '<span class="badge badge--warning">'.trans('Inactive').'</span>';
        }

        return $html;
    }
}
