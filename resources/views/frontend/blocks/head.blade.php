<head>
  <title> @yield('meta_title') </title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <meta name="keywords" content="@yield('meta_keyword')">
  <meta name="description" itemprop="description" content="@yield('meta_description')"/>
  <meta property="og:title" content="@yield('meta_title')"/>
  <meta property="og:description" content="@yield('meta_description')"/>
  <meta property="og:url" content="https://{{ $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] }}"/>
  <meta property="og:type" content="page"/>
  <meta property="og:locale" content="{{ $websitesLang->locale }}"/>
  <meta property="og:site_name" content="Descotis Website"/>
  <meta property="og:image" content="{{ url('') }}/@yield('meta_image')"/>
  <meta property="og:image:url" content="{{ url('') }}/@yield('meta_image')"/>
  <meta property="og:image:size"content="350"/>
  <meta name="twitter:title" content="@yield('meta_title')"/>
  <meta name="twitter:card" content="@yield('meta_description')"/>
  <meta name="twitter:site" content="{{ url('') }}/" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  <!-- Styles -->
  <style>
      html, body {
          background-color: #fff;
          color: #636b6f;
          font-family: 'Nunito', sans-serif;
          font-weight: 200;
          height: 100vh;
          margin: 0;
      }
      .full-height {
          height: 100vh;
      }
      .flex-center {
          align-items: center;
          display: flex;
          justify-content: center;
      }
      .position-ref {
          position: relative;
      }
      .top-right {
          position: absolute;
          right: 10px;
          top: 18px;
      }
      .content {
          text-align: center;
      }
      .title {
          font-size: 84px;
      }
      .links > a {
          color: #636b6f;
          padding: 0 25px;
          font-size: 13px;
          font-weight: 600;
          letter-spacing: .1rem;
          text-decoration: none;
          text-transform: uppercase;
      }
      .m-b-md {
          margin-bottom: 30px;
      }
  </style>

  @yield('header-css')
</head>
