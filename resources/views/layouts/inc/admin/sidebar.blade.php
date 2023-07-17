<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/orders')}}">
          <i class="mdi mdi-chart-pie menu-icon"></i>
          <span class="menu-title">Orders</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">Category</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/category/create')}}">Add Category</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/category')}}">View Category</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Products</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/products/create')}}"> Add Products </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/products')}}"> View Products </a></li>
          </ul>
        </div>
      </li>




      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/brands')}}">
          <i class="mdi mdi-emoticon menu-icon"></i>
          <span class="menu-title">Brands</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/colors')}}">
          <i class="mdi mdi-emoticon menu-icon"></i>
          <span class="menu-title">Colors</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#uii-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">Users</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="uii-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="#">Add Category</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">View Category</a></li>
          </ul>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/sliders')}}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Home Slider</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/settings')}}">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Site Setting</span>
        </a>
      </li>
    </ul>
</nav>