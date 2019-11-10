<div class="category-content">
    <div class="input-group">
        <div class="input-group-addon">
            <i class="website-scope-icon icon-earth"></i>
        </div>
        <input type="hidden" id="change_website_scope_url" value="{{ url(env('BACKEND_ROUTE').'/setting/scope') }}">
        <select class="bootstrap-select website-scope" data-width="100%" style="display:none;">
            @foreach(config('sys.website') as $web)
                <option class="text-size-small" value="{{ $web->id }}" {{ ($web->id == Session::get('sys_website_scope'))? 'selected="selected"' : '' }} >{{ ($web->id == 0)? $web->name.' (Default)' : $web->name }}</option>
            @endforeach
        </select>
    </div>
</div>