<ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
    <span>Application Version</span>
    <span>2.0</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
    <span>Admin Version</span>
    <span>4.3.6</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
    <span>Laravel Version</span>
    <span>{{ app()->version() }}</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
    <span>Timezone</span>
    <span>{{ config('app.timezone') }}</span>
  </li>
</ul>