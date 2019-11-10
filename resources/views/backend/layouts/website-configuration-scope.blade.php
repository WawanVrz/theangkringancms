<!-- Sidebar Configuration Scope -->
<div class="sidebar-category">
<div class="category-title">
    <span>{{ trans('backend/core.website') }}</span>
    <ul class="icons-list">
        <li><a href="#" data-action="collapse"></a></li>
    </ul>
</div>
<div class="category-content" style="padding:20px; min-height: auto;">
    <div class="input-group">
        <div class="input-group-addon">
            <i class="website-scope-icon icon-earth"></i>
        </div>
        <select class="bootstrap-select website-configuration-scope" data-width="100%" style="display:none;">
            @foreach(config('sys.website') as $web)
                @php $selected_website = (isset($_GET['website'])) ? $_GET['website'] : '0'; @endphp
                <option 
                    class="text-size-small" 
                    value="{{ $web->id }}" 
                    {{ ($web->id == $selected_website)? 'selected="selected"' : '' }} >
                    {{ ($web->id == 0)? $web->name.' (Default)' : $web->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
</div>
<!-- /Sidebar Configuration Scope -->