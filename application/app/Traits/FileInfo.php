<?php

namespace App\Traits;

trait FileInfo
{

    /*
    |--------------------------------------------------------------------------
    | File Information
    |--------------------------------------------------------------------------
    |
    | This trait basically contain the path of files and size of images.
    | All information are stored as an array. Developer will be able to access
    | this info as method and property using FileManager class.
    |
    */

    public function fileInfo(){

        $data['depositVerify'] = [
            'path'      =>'assets/images/verify/deposit'
        ];
        $data['verify'] = [
            'path'      =>'assets/verify'
        ];
        $data['default'] = [
            'path'      => 'assets/images/general/default.png',
        ];
      
        $data['ticket'] = [
            'path'      => 'assets/support',
        ];
        $data['logoIcon'] = [
            'path'      => 'assets/images/general',
        ];
        $data['favicon'] = [
            'size'      => '128x128',
        ];
        $data['extensions'] = [
            'path'      => 'assets/images/plugins',
            'size'      => '36x36',
        ];
        $data['seo'] = [
            'path'      => 'assets/images/seo',
            'size'      => '1180x600',
        ];
        $data['userProfile'] = [
            'path'      =>'assets/images/user/profile',
            'size'      =>'350x300',
        ];
        $data['adminProfile'] = [
            'path'      =>'assets/admin/images/profile',
            'size'      =>'400x400',
        ];
        $data['category'] = [
            'path'      =>'assets/images/frontend/category',
            'size'      =>'32x32',
        ];
        $data['banner'] = [
            'path'      =>'assets/images/frontend/banner',
        ];
        $data['about'] = [
            'path'      =>'assets/images/frontend/about',
        ];
        $data['testimonial'] = [
            'path'      =>'assets/images/frontend/testimonial',
        ];
        $data['blog'] = [
            'path'      =>'assets/images/frontend/blog',
        ];
        $data['paymentMethod'] = [
            'path'      =>'assets/images/frontend/payment_method',
        ];
        return $data;
	}

}
