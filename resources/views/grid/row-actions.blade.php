<div class="grid-dropdown-actions dropdown">
    {!! $view !!} {!! $edit !!}
    <a href="#" data-toggle="dropdown">
        更多<i class="feather icon-more-vertical"></i>
    </a>
    <ul class="dropdown-menu" style="left: -65px;">

        @foreach($default as $action)
            <li class="dropdown-item">{!! Dcat\Admin\Support\Helper::render($action) !!}</li>
        @endforeach

        @if(!empty($custom))

            @if(!empty($default))
                <li class="dropdown-divider"></li>
            @endif

            @foreach($custom as $action)
                <li class="dropdown-item">{!! $action !!}</li>
            @endforeach
        @endif
    </ul>
</div>
<style>
    a {
        padding: 0 4px;
    }
</style>
