 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light justify-between">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="{{route('products.display')}}" class="nav-link active">Home</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="shop.html" class="nav-link">Shop</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="blog.html" class="nav-link">Blog</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="contact.html" class="nav-link">Contact</a>
         </li>
     </ul>

     <ul class="navbar-nav">
         <li>
             <a href="account.html" class="mx-3">
                 <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
             </a>
         </li>
         <li>
             <a href="wishlist.html" class="mx-3">
                 <iconify-icon icon="mdi:heart" class="fs-4"></iconify-icon>
             </a>
         </li>
         <li class="">
             <a href="#" class="mx-3 position-relative" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                 <iconify-icon icon="mdi:cart" class="fs-4"></iconify-icon>
                 <span class="position-absolute translate-middle badge rounded-circle bg-primary pt-2">03</span>
             </a>
         </li>
     </ul>

 </nav>