@if( Session::has("success") )
    <div class="alert alert-success alert-block alert-dismissible" role="alert">
        <button class="close" data-dismiss="alert">×</button>
        {{ Session::get("success") }}
    </div>

@elseif( Session::has("error") )
    <div class="alert alert-danger alert-block alert-dismissible" role="alert">
        <button class="close" data-dismiss="alert" aria-label="close">×</button>
        {{ Session::get("error") }}
    </div>

@elseif( Session::has("info") )
    <div class="alert alert-info alert-block alert-dismissible" role="alert">
        <button class="close" data-dismiss="alert" aria-label="close">×</button>
        {{ Session::get("warning") }}
    </div>

@elseif( Session::has("warning") )
    <div class="alert alert-warning alert-block alert-dismissible" role="alert">
        <button class="close" data-dismiss="alert" aria-label="close">×</button>
        {{ Session::get("warning") }}
    </div>
@endif