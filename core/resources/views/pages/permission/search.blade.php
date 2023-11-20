<div class="mb-3 col-lg-4">
    <label class="form-label">Search</label>
    <input type="text" class="form-control" name="search_query" id="search_query" placeholder="Enter name/ slug" />
</div>
<div class="mb-3 col-lg-4">
    <label class="form-label">Search By Module</label>
    <select class="form-control select2" name="search_module_id" id="search_module_id">
        <option selected value="0">Select</option>
        @forelse (moduleChildList() as $module)
        <option value="{{ $module->id }}">{{ $module->name }}</option>
        @empty
        <option disabled>No modules found</option>
        @endforelse
    </select>
</div>