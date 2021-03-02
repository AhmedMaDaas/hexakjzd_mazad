<div class="navbar">
  <img src="{{ url('/') }}/admin_design/images/list.png" class="list">
  <div class="admin">
    <img src="{{ url('/storage/' . auth()->guard('admin')->user()->user->photo) }}" class="adminphoto">
    <p class="adminname">{{ auth()->guard('admin')->user()->name }}</p>
    <a href="{{ url('admin/logout') }}"><img src="{{ url('/') }}/admin_design/images/logout%20(1).png" class="logout"></a>
  </div>
</div>