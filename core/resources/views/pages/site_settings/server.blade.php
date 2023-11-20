<ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
    <span>PHP Version</span>
    <span>{{ phpversion() }}</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
    <span>Server Software</span>
    <span>{{ $server->SERVER_SOFTWARE }}</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
    <span>Server IP Address</span>
    <span>{{ $server->SERVER_ADDR }}</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
    <span>Server Protocol</span>
    <span>{{ $server->SERVER_PROTOCOL }}</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
    <span>HTTP Host</span>
    <span>{{ $server->HTTP_HOST }}</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
    <span>Server Port</span>
    <span>{{ $server->SERVER_PORT }}</span>
  </li>
</ul>