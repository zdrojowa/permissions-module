<li class="permission-item">
    <div class="presence-info">
        <div class="checkbox" data-anchor="{{Selene\Support\Facades\Core::aclRepository()->getAnchor($presence)}}"></div>
        <span class="presence-name">{{ $presence->getName() }}</span>
    </div>
    @if($presence->hasChildren())
        <ul>
            @foreach($presence->getChildren() as $presence)
                @include('PermissionsModule::partials.presence')
            @endforeach
        </ul>
    @endif
</li>

