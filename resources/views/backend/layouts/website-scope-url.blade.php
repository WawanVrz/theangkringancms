<div class="sidebar-category">
    <div class="category-title">
        <span>{{ trans('backend/core.website') }}</span>
    </div>
    <div class="category-content" style="padding:20px; min-height: 10px;">
        <div class="input-group">
            <div class="input-group-addon">
                <i class="website-scope-icon icon-earth"></i>
            </div>
            <select class="bootstrap-select website-scope-url" data-width="100%" style="display:none;">
                @foreach(config('sys.website') as $web)
                    <option 
                    class="text-size-small" 
                    value="{{ $web->id }}" 
                    {{ ($web->id == $_GET['website'])? 'selected="selected"' : '' }} >
                    {{ ($web->id == 0)? $web->name.' (Default)' : $web->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>