<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('admoin/img/sidebar-1.jpg') }}">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo"><a href="#" class="simple-text logo-normal">
            AddToCart
        </a></div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ Request::is('dashboard') ? 'active':'' }}  ">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('categories','add-category') ? 'active':'' }}">
                <a class="nav-link" href="{{ url('categories') }}">
                    <i class="material-icons">people</i>
                    <p>Categories</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('sub-category','add-subcategory') ? 'active':'' }}">
                <a class="nav-link" href="{{ url('sub-category') }}">
                    <i class="material-icons">person</i>
                    <p>Sub Category</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('products','add-products') ? 'active':'' }}">
                <a class="nav-link" href="{{ url('products') }}">
                    <i class="material-icons">content_paste</i>
                    <p>Products</p>
                </a>
            </li>        
            <li class="nav-item {{ Request::is('users') ? 'active':'' }}">
                <a class="nav-link" href="{{ url('users') }}">
                    <i class="material-icons">persons</i>
                    <p>Users</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('orders','admin/view-order','order-history') ? 'active':'' }}">
                <a class="nav-link" href="{{ url('orders') }}">
                    <i class="material-icons">content_paste</i>
                    <p>Orders</p>
                </a>
            </li>
        </ul>
    </div>
</div>
