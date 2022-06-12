<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Splash Shop</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ url('/dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="menu-label">Gestionare Site</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-box'></i>
                </div>
                <div class="menu-title">Categorie</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.category') }}"><i class="bx bx-right-arrow-alt"></i>Toate</a>
                </li>
                <li> <a href="{{ route('add.category') }}"><i class="bx bx-right-arrow-alt"></i>Adaugă categorie </a>
                </li>

            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">SubCategorie</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Toate</a>
                </li>
                <li> <a href="{{ route('add.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Adaugă
                        SubCategorie</a>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Slider</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.slider') }}"><i class="bx bx-right-arrow-alt"></i>Toate</a>
                </li>
                <li> <a href="{{ route('add.slider') }}"><i class="bx bx-right-arrow-alt"></i>Adaugă Slider</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="lni lni-tag"></i>
                </div>
                <div class="menu-title">Produs</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.product') }}"><i class="bx bx-right-arrow-alt"></i>Toate</a>
                </li>
                <li> <a href="{{ route('add.product') }}"><i class="bx bx-right-arrow-alt"></i>Adaugă Produs</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="{{ route('contact.message') }}">
                <div class="parent-icon"><i class="lni lni-envelope"></i>
                </div>
                <div class="menu-title">Mesaje</div>
            </a>
        </li>
        <li>
            <a href="{{ route('all.review') }}">
                <div class="parent-icon"><i class="lni lni-angellist"></i>
                </div>
                <div class="menu-title">Review Produs</div>
            </a>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="lni lni-information"></i>
                </div>
                <div class="menu-title">Site Info</div>
            </a>
            <ul>
                <li> <a href="{{ route('getsite.info') }}"><i class="bx bx-right-arrow-alt"></i>Editează Site
                        Info</a>
            </ul>
        </li>
        <li class="menu-label">Gestionare Comenzi</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-message-square-edit'></i>
                </div>
                <div class="menu-title">Comenzi</div>
            </a>
            <ul>
                <li> <a href="{{ route('pending.order') }}"><i class="bx bx-right-arrow-alt"></i>Comenzi în așteptare
                    </a>
                <li> <a href="{{ route('processing.order') }}"><i class="bx bx-right-arrow-alt"></i>Comenzi în
                        procesare</a>
                </li>
                <li> <a href="{{ route('complete.order') }}"><i class="bx bx-right-arrow-alt"></i>Comenzi
                        completate</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Suport</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
