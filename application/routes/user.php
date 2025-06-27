<?php


Route::namespace('User\Auth')->name('user.')->group(function () {

    Route::controller('LoginController')->group(function(){
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('logout', 'logout')->name('logout');
    });

    Route::controller('RegisterController')->group(function(){
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('register', 'register')->middleware('registration.status');
        Route::post('check-mail', 'checkUser')->name('checkUser');
    });

    Route::controller('ForgotPasswordController')->group(function(){
        Route::get('password/reset', 'showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'sendResetCodeEmail')->name('password.email');
        Route::get('password/code-verify', 'codeVerify')->name('password.code.verify');
        Route::post('password/verify-code', 'verifyCode')->name('password.verify.code');
    });
    Route::controller('ResetPasswordController')->group(function(){
        Route::post('password/reset', 'reset')->name('password.update');
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
    });
});

Route::middleware('auth')->name('user.')->group(function () {
    //authorization
    Route::namespace('User')->controller('AuthorizationController')->group(function(){
        Route::get('authorization', 'authorizeForm')->name('authorization');
        Route::get('resend/verify/{type}', 'sendVerifyCode')->name('send.verify.code');
        Route::post('verify/email', 'emailVerification')->name('verify.email');
        Route::post('verify/mobile', 'mobileVerification')->name('verify.mobile');
        Route::post('verify/g2fa', 'g2faVerification')->name('go2fa.verify');
    });

    Route::middleware(['check.status'])->group(function () {

        Route::get('user/data', 'User\UserController@userData')->name('data');
        Route::post('user/data/submit', 'User\UserController@userDataSubmit')->name('data.submit');

        Route::middleware('registration.complete')->namespace('User')->group(function () {

            Route::controller('UserController')->group(function(){
                Route::get('dashboard', 'home')->name('home');

                //2FA
                Route::get('twofactor', 'show2faForm')->name('twofactor');
                Route::post('twofactor/enable', 'create2fa')->name('twofactor.enable');
                Route::post('twofactor/disable', 'disable2fa')->name('twofactor.disable');

                //Report
                Route::any('deposit/history', 'depositHistory')->name('deposit.history');
                Route::get('transactions','transactions')->name('transactions');

                Route::get('attachment-download/{fil_hash}','attachmentDownload')->name('attachment.download');
            });

            //Profile setting
            Route::controller('ProfileController')->group(function(){
                Route::get('profile/setting', 'profile')->name('profile.setting');
                Route::post('profile/setting', 'submitProfile');
                Route::get('change-password', 'changePassword')->name('change.password');
                Route::post('change-password', 'submitPassword');

                Route::post('profile', 'imageUpdate')->name('profile.update');
            });

             //Order
             Route::controller('OrderController')->group(function(){
                Route::get('order/list', 'index')->name('order.index');
                Route::get('order/pending', 'pendingOrder')->name('order.pending');
                Route::get('order/processing', 'processingOrder')->name('order.processing');
                Route::get('order/complete', 'completeOrder')->name('order.complete');
                Route::get('order/refund', 'refundOrder')->name('order.refund');
                Route::get('order/cancelle', 'cancelleOrder')->name('order.cancelle');


                // Service order
                Route::get('order/create', 'create')->name('order.create');
                Route::post('order/service', 'ServicePayment')->name('service.order.payment');
                // get category wise services
                Route::get('services/{id}', 'getService')->name('get.category.service');
                // get category wise service price
                Route::get('service/price/{id}', 'getServicePrice')->name('get.category.service.price');
                // direct order
                Route::get('order/{id}', 'directOrder')->name('direct.order');


                // brandPackage order
                Route::get('brand-package/{id}', 'brandPackage')->name('brnad.package');
                Route::post('brand-package/payment', 'brandPackagepPayment')->name('brand.package.payment');
                Route::get('brand/package/list', 'getPackageOrder')->name('brnad.package.index');


            });

        });

        // Payment
        Route::middleware('registration.complete')->controller('Gateway\PaymentController')->group(function(){
            Route::any('/deposit', 'deposit')->name('deposit');
            Route::post('deposit/insert', 'depositInsert')->name('deposit.insert');
            Route::get('deposit/confirm', 'depositConfirm')->name('deposit.confirm');
            Route::get('deposit/manual', 'manualDepositConfirm')->name('deposit.manual.confirm');
            Route::post('deposit/manual', 'manualDepositUpdate')->name('deposit.manual.update');
        });
    });
});
