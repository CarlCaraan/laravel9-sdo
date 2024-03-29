<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms | Division of Laguna</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/main/app-dark.css') }}">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/logo/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/logo/favicon.ico') }}" type="image/png">">
</head>

<body>
    <div class="py-5" id="error">


        <div class="error-page container">
            <div class="col-md-8 col-12 offset-md-2">
                <h3 class="error-title text-center mb-5">Privacy Policy</h3>
                @php
                $adminsiteinfo = DB::table('user_site_infos')->first();
                @endphp
                <div class="fs-5 text-gray-600">
                    {!! $adminsiteinfo->privacy !!}
                </div>
            </div>
        </div>


    </div>
</body>

</html>