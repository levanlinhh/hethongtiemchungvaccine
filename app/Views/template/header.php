
<!-- header section starts  -->

<header class="header fixed-top">
    

   <div class="container">

      <div class="row align-items-center justify-content-between">

         <a href="./" class="logo">CỔNG THÔNG <span>TIN TIÊM CHỦNG COVID-19</span></a>

         <nav class="nav">
            <a href="./">Trang chủ</a>
            <a href="./registration">Đăng ký tiêm</a>
            <a href="./search">Tra cứu</a>
            <a href="#tt">Tin tức</a>
            <a href="./contact">Liên hệ</a>
            <?php if (isset($isAdmin) && $isAdmin) : ?>
               <a href="./admin">ADMIN</a>
            <?php endif; ?>
            <?php if ($isLogin) : ?>
               <a href="./logout">Đăng xuất</a>
            <?php else : ?>
               <a href="./login">Đăng nhập</a>
            <?php endif; ?>
         </nav>

         

      </div>

   </div>

</header>
<!-- header section ends -->
