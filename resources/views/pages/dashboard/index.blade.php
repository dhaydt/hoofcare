@extends('layouts.dashboard.app')
@section('content')
<div class="container-fluid p-0 ">

  @include('pages.dashboard.partials._subHeader')
  <div class="row ">
    <div class="col-lg-12 card_height_100">
      {{-- <div class="white_card mb_20">
        <div class="white_card_header">
          <div class="box_header m-0">
            <div class="main-title">
              <h3 class="m-0">Revenue</h3>
            </div>
            <div class="float-lg-right float-none sales_renew_btns justify-content-end">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link active" href="#">This Week</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Last Week</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">Last Month</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="white_card_body" style="height: 286px;">
          <canvas id="bar"></canvas>
        </div>
      </div> --}}
      <div class="white_card mb_20">
        <div
          class="white_card_body renew_report_card d-flex align-items-center justify-content-between flex-wrap">
          <div class="renew_report_left">
            <h4 class="f_s_19 f_w_600 color_theme2 mb-0">Welcome to <b>HOOFCARE</b> User Dashboard</h4>
            {{-- <p class="color_gray2 f_s_12 f_w_600">There are many variations of passages.</p> --}}
          </div>
          {{-- <div class="create_report_btn">
            <a href="#" class="btn_1 mt-1 mb-1">Create Report</a>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection