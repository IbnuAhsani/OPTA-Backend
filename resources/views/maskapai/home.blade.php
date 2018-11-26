{{-- 

# The data needed here is:
- $title: String

--}}

@extends('maskapai.template')

@section('style')
<style>
.home-card {
    margin: auto;
    margin-top: 4rem;
}
.home-form {
    margin: auto;
    padding-right: 16px;
    padding-left: 16px;
}
</style>
@endsection

@section('main')
<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">{{ $title }}</span>
      <!-- Navigation. We hide it in small screens. -->
      <nav class="mdl-navigation mdl-layout--large-screen-only">
      </nav>
    </div>
  </header>
  <main class="mdl-layout__content">
    <div class="page-content">
    
        <div class="demo-card-wide mdl-card mdl-shadow--2dp home-card">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Login</h2>
            </div>
            <div>
            <form method="POST" action="/maskapai/login">
                {{ csrf_field() }}
                <div class="home-form">
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" name="email" type="email" id="email">
                        <label class="mdl-textfield__label" for="email">Email</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" name="password" type="password" id="password">
                        <label class="mdl-textfield__label" for="password">Password</label>
                    </div>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                        Login
                    </button>
                </div>
            </form>
        </div>
        
    </div>
  </main>
</div>
@endsection