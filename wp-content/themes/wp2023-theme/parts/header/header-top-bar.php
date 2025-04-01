<div class="row">
    <div class="col-lg-3">
        <div class="header__logo" style="display: flex; justify-content: space-around; ">
            <a href="<?= home_url() ?>"><img src="https://ogani.com.vn/public/img/logo.png" style="width: 120px;" alt=""></a>
        </div>
    </div>
    <div class="col-lg-6">
        <?php get_template_part("parts/navigation/main-menu"); ?>

    </div>
    <div class="col-lg-3">
        <div class="header__cart">
            <ul>
                <li class="cart-icon">
                    <a href="#"><i class="fa fa-shopping-bag"></i> <span class="count">0</span></a>
                    <div class="cart-popup-wrapper">
                        <div class="cart-popup-content">
                            <h3 class="cart-popup-heading section-small-heading">Giỏ hàng</h3>
                            <div class="cart-popup-body">

                                <div style="border-top: solid 1px #D3D3D3; padding-top: 10px; margin-top: 15px">
                                    Trống
                                </div>
                            </div>

                        </div>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</div>