@extends($activeTemplate.'layouts.frontend')
@section('content')

<!--=======-** Terms Of Service start **-=======-->
  <section class="login-area py-60" >
    <div class="container">
        <div class="row">
            <div class="col-xl-10 offset-xl-1 wyg">
                <div class="wyg mb-30">
                    <p>
                        @php
                            echo $cookie->data_values->description
                        @endphp
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=======-** Terms Of Service End **-=======-->


@endsection

@push('style')
<style>
    .wyg h1, .wyg h2, .wyg h3, .wyg h4 {
        color:hsl(var(--black));
    }
    .wyg p{
        color:hsl(var(--black));
    }
    .wyg ul {
        margin: 35px;
    }
    .wyg ul li{
        list-style-type: disc;
        color:hsl(var(--black));
    }

    /*========= dark css =======*/
    .dark .wyg h1, .dark .wyg h2, .dark .wyg h3, .dark .wyg h4 {
        color:hsl(var(--white)/.6);
    }
    .dark .wyg p{
        color:hsl(var(--white)/.6);
    }
    .dark .wyg ul {
        margin: 35px;
    }
    .dark .wyg ul li{
        list-style-type: disc;
        color:hsl(var(--white)/.6);
    }
</style>
@endpush
