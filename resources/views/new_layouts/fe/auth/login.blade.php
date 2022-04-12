<div class="login-section">
    <div class="ct-modal-body">
        <h5 class="desc-main-text-lg mb-4 f-Asap_bold text-capitalize text-center">masuk akun veganesia</h5>
        <form action="" class="form-vegan --addrs-set" id="formLogin" autocomplete="off">
            @csrf
            <div>
                <h6 class="clr-grey-txt f-Asap_medium med-small-fnt mb-3">Email atau nomor HP</h6>
                <div class="float-inpt-fld">
                    <input type="email" class="floatfield form-control field-main-oz" id="email" name="email" placeholder=" " aria-describedby="email">
                    <div class="lbl-float-inpt">
                        <label for="email">Email atau nomor HP</label>
                    </div>
                </div>
            </div>
            <div>
                <h6 class="clr-grey-txt f-Asap_medium med-small-fnt mb-3">Password</h6>
                <div class="float-inpt-fld">
                    <input type="password" class="floatfield form-control field-main-oz" id="password" name="password" placeholder=" " aria-describedby="password" autocomplete="new-password">
                    <div class="lbl-float-inpt">
                        <label for="password">Password</label>
                    </div>
                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
            </div>
            <div class="d-block ml-auto text-right mt-3">
                <a href="{{ url('forgot_password') }}" class="text-capitalize text-black mn-small-fnt">
                    lupa password
                </a>
            </div>
            <div class="mt-4 mb-4">
                <button class="text-capitalize btn-vegan green-bg-btn">Masuk</button>
            </div>
            <div class="text-center">
                <p class="mb-0 text-black mn-small-fnt">Jika belum punya akun silahkan 
                    <span>
                        <a type="button" href="{{ url('register') }}" class="clr-green">
                            Daftar
                        </a>
                    </span>
                </p>
            </div>
        </form>
    </div>
</div>