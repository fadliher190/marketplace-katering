<section>
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="treeview"><a href="{{ route('merchant.dashboard') }}" class="flex"> <i class="fa fa-dashboard"></i> <span class="">Dashboard</span></a>
      </li>
      <li class="header">MASTER DATA</li>
      <li class="treeview"><a href="{{ route('merchant.product.index') }}"><i class="fa-solid fa-boxes-stacked"></i> <span>Produk</span></a></li>
      <li class="treeview"><a href="{{ route('merchant.product.create') }}"><i class="fa-solid fa-folder-plus"></i> <span>Tambah Produk Baru</span></a></li>
      </li>
      <li class="header">TRANSACTION</li>
      {{-- <li class="treeview">
        <a href="#">
          <i class="fa fa-share"></i> <span>Multilevel</span>
          <i class="fa fa-angle-left pull-right "></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
        </ul>
      </li> --}}
      <li><a href="#"><i class="fa-solid fa-file-pen"></i> <span>Pesanan</span></a>
    </li>
    </ul>
</section>
